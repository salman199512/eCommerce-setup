<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Show the homepage.
     */
    public function index()
    {
        // Fetch featured products
        $featuredProducts = Product::where('status', 1)
                                   ->where('is_featured', 1)
                                   ->with(['media', 'category', 'variants'])
                                   ->latest()
                                   ->take(8)
                                   ->get();

        // New Arrivals
        $newArrivals = Product::where('status', 1)
                              ->where('is_new_arrival', 1)
                              ->with(['media', 'category', 'variants'])
                              ->latest()
                              ->take(8)
                              ->get();

        // Best Sellers
        $bestSellers = Product::where('status', 1)
                              ->where('is_best_seller', 1)
                              ->with(['media', 'category', 'variants'])
                              ->latest()
                              ->take(8)
                              ->get();

        // Deal of the Day
        $dealProducts = Product::where('status', 1)
                               ->whereNotNull('deal_end_date')
                               ->where('deal_end_date', '>', now())
                               ->with(['media', 'category', 'variants'])
                               ->take(4)
                               ->get();

        // Fetch dynamic content
        $categories = Category::where('status', 1)->take(10)->get();
        $sliders = \App\Models\Slider::where('status', 1)->orderBy('sort_order')->get();
        $banners = \App\Models\Banner::where('status', 1)->orderBy('sort_order')->get();
        $testimonials = \App\Models\Testimonial::where('status', 1)->latest()->get();

        return view('frontend.home.index', compact('featuredProducts', 'newArrivals', 'bestSellers', 'dealProducts', 'categories', 'sliders', 'banners', 'testimonials'));
    }

    /**
     * Show the product listing page.
     */
    public function products(Request $request)
    {
        $query = Product::where('status', 1)->with(['media', 'category', 'brand', 'variants.attributes']);

        // Search logic
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Category filter
        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Subcategory filter (Point 4)
        if ($request->has('sub_category') && !empty($request->sub_category)) {
            $query->whereHas('subCategory', function ($q) use ($request) {
                $q->where('slug', $request->sub_category);
            });
        }

        // Brand filter
        if ($request->has('brand') && !empty($request->brand)) {
            $query->whereHas('brand', function ($q) use ($request) {
                $q->where('slug', $request->brand);
            });
        }

        // Attribute filter (Point 4)
        if ($request->has('attributes') && is_array($request->attributes)) {
            $attrIds = array_filter($request->attributes);
            if (!empty($attrIds)) {
                $query->whereHas('variants.attributes', function($q) use ($attrIds) {
                    $q->whereIn('attributes.id', $attrIds);
                });
            }
        }

        // Price range filter (Point 4)
        if ($request->has('min_price') || $request->has('max_price')) {
            $minPrice = $request->get('min_price', 0);
            $maxPrice = $request->get('max_price', 999999);

            $query->whereHas('variants', function($q) use ($minPrice, $maxPrice) {
                $q->whereBetween('final_price', [$minPrice, $maxPrice]);
            });
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        if ($sort == 'price_low') {
            $query->join('product_variants', 'products.id', '=', 'product_variants.product_id')
                  ->select('products.*')
                  ->groupBy('products.id')
                  ->orderBy(\DB::raw('MIN(product_variants.final_price)'), 'asc');
        } elseif ($sort == 'price_high') {
            $query->join('product_variants', 'products.id', '=', 'product_variants.product_id')
                  ->select('products.*')
                  ->groupBy('products.id')
                  ->orderBy(\DB::raw('MAX(product_variants.final_price)'), 'desc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->appends($request->all());

        // Data for Sidebar (Point 4)
        $categories = Category::where('status', 1)->with('subCategories')->get();
        $attributeGroups = \App\Models\AttributeGroup::where('status', 1)->with('attributes')->get();
        $brands = \App\Models\Brand::where('status', 1)->get();

        return view('frontend.products.index', compact('products', 'categories', 'attributeGroups', 'brands'));
    }

    /**
     * Show the product detail page.
     */
    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)
                          ->where('status', 1)
                          ->with(['media', 'variants.attributes', 'attributes', 'category'])
                          ->firstOrFail();

        // Get related products
        $relatedProducts = Product::where('category_id', $product->category_id)
                                  ->where('id', '!=', $product->id)
                                  ->take(4)
                                  ->get();

        return view('frontend.products.show', compact('product', 'relatedProducts'));
    }

    /**
     * Get search suggestions.
     */
    public function searchSuggestions(Request $request)
    {
        $search = $request->get('q');

        if (empty($search)) {
            return response()->json([]);
        }

        $products = Product::where('status', 1)
            ->where('title', 'like', "%{$search}%")
            ->with(['media', 'variants'])
            ->take(8)
            ->get();

        $results = $products->map(function ($product) {
            $firstVariant = $product->variants->first();
            return [
                'id' => $product->id,
                'title' => $product->title,
                'slug' => $product->slug,
                'uuid' => $product->uuid,
                'image' => $product->avatar_url,
                'price' => $firstVariant ? (float)($firstVariant->final_price ?? $firstVariant->price) : 0,
            ];
        });

        return response()->json($results);
    }
}
