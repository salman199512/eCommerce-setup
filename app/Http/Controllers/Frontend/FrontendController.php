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
        $categories = Category::where('status', 1)->take(6)->get();
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
        $query = Product::where('status', 1)->with(['media', 'category', 'brand']);

        // Search logic
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Category filter
        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $products = $query->paginate(12);

        return view('frontend.products.index', compact('products'));
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
}
