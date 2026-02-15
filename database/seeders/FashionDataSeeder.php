<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FashionDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Categories & Subcategories
        $categoriesData = [
            'Men' => ['T-Shirts', 'Jeans', 'Jackets', 'Shirts', 'Knitwear'],
            'Women' => ['Dresses', 'Tops', 'Skirts', 'Blouses', 'Knitwear'],
            'Accessories' => ['Bags', 'Watches', 'Sunglasses', 'Jewelry', 'Belts'],
            'Footwear' => ['Sneakers', 'Boots', 'Loafers', 'Heels', 'Sandals'],
            'Outerwear' => ['Coats', 'Blazers', 'Hoodies', 'Trench', 'Parkas'],
        ];

        foreach ($categoriesData as $catTitle => $subs) {
            $slug = \Illuminate\Support\Str::slug($catTitle);
            $category = \App\Models\Category::updateOrCreate(
                ['slug' => $slug],
                ['title' => $catTitle, 'status' => 1]
            );

            foreach ($subs as $subTitle) {
                $subSlug = \Illuminate\Support\Str::slug($subTitle);
                \App\Models\SubCategory::updateOrCreate(
                    ['slug' => $subSlug, 'category_id' => $category->id],
                    ['title' => $subTitle, 'status' => 1]
                );
            }
        }

        // 2. Brands
        $brands = ['Zenith', 'Aria', 'Luxe', 'Urban', 'Minimalist', 'Archive', 'Nord', 'Ethereal', 'Vanguard'];
        foreach ($brands as $brandName) {
            \App\Models\Brand::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($brandName)],
                ['name' => $brandName, 'status' => 1]
            );
        }

        // 3. Attribute Groups & Attributes
        $attrGroups = [
            'Size' => ['S', 'M', 'L', 'XL'],
            'Color' => ['Black', 'Pure White', 'Deep Red', 'Navy Blue', 'Forest Green', 'Tan'],
        ];

        foreach ($attrGroups as $groupTitle => $attrs) {
            $group = \App\Models\AttributeGroup::where('title', $groupTitle)->first();
            if (!$group) {
                $group = \App\Models\AttributeGroup::create([
                    'title' => $groupTitle,
                    'status' => 1,
                ]);
            }

            foreach ($attrs as $attrTitle) {
                \App\Models\Attribute::updateOrCreate(
                    ['title' => $attrTitle, 'attribute_group_id' => $group->id],
                    ['status' => 1]
                );
            }
        }

        // 4. Detailed Product Data (25 Items)
        $products = [
            // Men's Collection
            ['cat' => 'Men', 'sub' => 'T-Shirts', 'brand' => 'Luxe', 'title' => 'Signature Oversized Tee', 'price' => 45.00, 'tags' => ['is_new_arrival' => true]],
            ['cat' => 'Men', 'sub' => 'Jeans', 'brand' => 'Urban', 'title' => 'Slim Fit Denim Jeans', 'price' => 89.00, 'tags' => ['is_best_seller' => true]],
            ['cat' => 'Men', 'sub' => 'Shirts', 'brand' => 'Minimalist', 'title' => 'Linen Oxford Shirt', 'price' => 65.00, 'tags' => []],
            ['cat' => 'Men', 'sub' => 'Knitwear', 'brand' => 'Archive', 'title' => 'Cashmere Crewneck Sweater', 'price' => 120.00, 'tags' => ['is_featured' => true]],
            ['cat' => 'Men', 'sub' => 'Jackets', 'brand' => 'Zenith', 'title' => 'Technical Bomber Jacket', 'price' => 145.00, 'tags' => ['is_new_arrival' => true]],

            // Women's Collection
            ['cat' => 'Women', 'sub' => 'Dresses', 'brand' => 'Aria', 'title' => 'Silk Wrap Midi Dress', 'price' => 150.00, 'tags' => ['is_best_seller' => true]],
            ['cat' => 'Women', 'sub' => 'Tops', 'brand' => 'Ethereal', 'title' => 'Ribbed Halter Top', 'price' => 38.00, 'tags' => []],
            ['cat' => 'Women', 'sub' => 'Skirts', 'brand' => 'Luxe', 'title' => 'Pleated Satin Skirt', 'price' => 75.00, 'tags' => ['is_new_arrival' => true]],
            ['cat' => 'Women', 'sub' => 'Blouses', 'brand' => 'Aria', 'title' => 'Embroidered Cotton Blouse', 'price' => 62.00, 'tags' => []],
            ['cat' => 'Women', 'sub' => 'Knitwear', 'brand' => 'Nord', 'title' => 'Mohair Blend Cardigan', 'price' => 110.00, 'tags' => ['is_featured' => true]],

            // Accessories
            ['cat' => 'Accessories', 'sub' => 'Bags', 'brand' => 'Luxe', 'title' => 'Structured Leather Tote', 'price' => 220.00, 'tags' => ['is_best_seller' => true]],
            ['cat' => 'Accessories', 'sub' => 'Watches', 'brand' => 'Zenith', 'title' => 'Minimalist Steel Watch', 'price' => 180.00, 'tags' => ['is_new_arrival' => true]],
            ['cat' => 'Accessories', 'sub' => 'Sunglasses', 'brand' => 'Archive', 'title' => 'Aviator Bio-Acetate Shades', 'price' => 135.00, 'tags' => []],
            ['cat' => 'Accessories', 'sub' => 'Jewelry', 'brand' => 'Ethereal', 'title' => 'Gold Vermeil Link Chain', 'price' => 95.00, 'tags' => []],
            ['cat' => 'Accessories', 'sub' => 'Belts', 'brand' => 'Urban', 'title' => 'Utility Webbing Belt', 'price' => 30.00, 'tags' => []],

            // Footwear
            ['cat' => 'Footwear', 'sub' => 'Sneakers', 'brand' => 'Vanguard', 'title' => 'Retro Runner Sneakers', 'price' => 125.00, 'tags' => ['is_new_arrival' => true, 'is_best_seller' => true]],
            ['cat' => 'Footwear', 'sub' => 'Boots', 'brand' => 'Nord', 'title' => 'Weatherproof Combat Boots', 'price' => 195.00, 'tags' => ['is_featured' => true]],
            ['cat' => 'Footwear', 'sub' => 'Loafers', 'brand' => 'Archive', 'title' => 'Penny Loafers in Suede', 'price' => 165.00, 'tags' => []],
            ['cat' => 'Footwear', 'sub' => 'Heels', 'brand' => 'Luxe', 'title' => 'Pointed Toe Stiletto', 'price' => 185.00, 'tags' => []],
            ['cat' => 'Footwear', 'sub' => 'Sandals', 'brand' => 'Aria', 'title' => 'Strappy Leather Sandals', 'price' => 85.00, 'tags' => []],

            // Outerwear
            ['cat' => 'Outerwear', 'sub' => 'Coats', 'brand' => 'Nord', 'title' => 'Over-sized Wool Topcoat', 'price' => 280.00, 'tags' => ['is_new_arrival' => true]],
            ['cat' => 'Outerwear', 'sub' => 'Blazers', 'brand' => 'Luxe', 'title' => 'Double Breasted Blazer', 'price' => 195.00, 'tags' => ['is_featured' => true]],
            ['cat' => 'Outerwear', 'sub' => 'Hoodies', 'brand' => 'Urban', 'title' => 'Heavyweight Boxy Hoodie', 'price' => 85.00, 'tags' => []],
            ['cat' => 'Outerwear', 'sub' => 'Trench', 'brand' => 'Minimalist', 'title' => 'Classic Cotton Trench', 'price' => 245.00, 'tags' => []],
            ['cat' => 'Outerwear', 'sub' => 'Parkas', 'brand' => 'Vanguard', 'title' => 'Down-filled Winter Parka', 'price' => 350.00, 'tags' => ['is_new_arrival' => true]],
        ];

        $sizes = \App\Models\Attribute::whereHas('attributeGroup', function($q) { $q->where('title', 'Size'); })->get();
        $colors = \App\Models\Attribute::whereHas('attributeGroup', function($q) { $q->where('title', 'Color'); })->get();

        foreach ($products as $p) {
            $cat = \App\Models\Category::where('title', $p['cat'])->first();
            $sub = \App\Models\SubCategory::where('title', $p['sub'])->where('category_id', $cat->id)->first();
            $brand = \App\Models\Brand::where('name', $p['brand'])->first();
            $slug = \Illuminate\Support\Str::slug($p['title']);

            $product = \App\Models\Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $cat->id,
                    'sub_category_id' => $sub->id ?? null,
                    'brand_id' => $brand->id ?? null,
                    'title' => $p['title'],
                    'description' => "Experience premium quality with our {$p['title']}. Crafted for style and durability, it features high-end materials and meticulous construction.",
                    'logistics_care' => 'Hand wash or gentle cycle. Do not bleach. Dry cleaning recommended for outer layers.',
                    'is_tax_included' => 1,
                    'status' => 1,
                    'is_new_arrival' => $p['tags']['is_new_arrival'] ?? false,
                    'is_best_seller' => $p['tags']['is_best_seller'] ?? false,
                    'is_featured' => $p['tags']['is_featured'] ?? false,
                ]
            );

            // Attach Attributes
            foreach ($sizes as $size) {
                if (!$product->attributes()->where('attribute_id', $size->id)->exists()) {
                    $product->attributes()->attach($size->id, ['attribute_group_id' => $size->attribute_group_id]);
                }
            }
            foreach ($colors->take(3) as $color) { // Just take first 3 colors to avoid massive variant spam
                if (!$product->attributes()->where('attribute_id', $color->id)->exists()) {
                    $product->attributes()->attach($color->id, ['attribute_group_id' => $color->attribute_group_id]);
                }
            }

            // Generate Variants
            foreach ($sizes as $size) {
                foreach ($colors->take(3) as $color) {
                    $sku = strtoupper(substr($p['brand'], 0, 2)) . '-' . strtoupper(substr($p['title'], 0, 2)) . '-' . $size->title . '-' . strtoupper(substr($color->title, 0, 1));
                    $variant = \App\Models\ProductVariant::updateOrCreate(
                        ['sku' => $sku, 'product_id' => $product->id],
                        [
                            'price' => $p['price'],
                            'discount' => rand(0, 1) ? rand(5, 20) : 0,
                            'final_price' => 0, // Will be calculated in model usually, but manually here for safety
                        ]
                    );
                    $variant->final_price = $variant->price - ($variant->price * ($variant->discount / 100));
                    $variant->save();

                    if (!$variant->attributes()->where('attribute_id', $size->id)->exists()) {
                        $variant->attributes()->attach($size->id, ['attribute_group_id' => $size->attribute_group_id]);
                    }
                    if (!$variant->attributes()->where('attribute_id', $color->id)->exists()) {
                        $variant->attributes()->attach($color->id, ['attribute_group_id' => $color->attribute_group_id]);
                    }
                }
            }
        }

        // 5. Attach Media (5 High-quality images per product)
        $allProducts = \App\Models\Product::all();
        $fashionKeywords = ['tee', 'jeans', 'jacket', 'shirt', 'sweater', 'dress', 'top', 'skirt', 'blouse', 'cardigan', 'bag', 'watch', 'sunglasses', 'jewelry', 'belt', 'sneaker', 'boots', 'loafers', 'heels', 'sandals', 'coat', 'blazer', 'hoodie', 'trench', 'parka'];

        foreach ($allProducts as $product) {
            // Count existing media to avoid duplicates and speed up re-runs
            if ($product->getMedia('product_images')->count() < 5) {
                // Determine keywords based on category/title
                $keywords = 'fashion';
                $titleWords = explode('-', \Illuminate\Support\Str::slug($product->title));
                $matches = array_intersect($titleWords, $fashionKeywords);
                
                if (!empty($matches)) {
                    $keywords = implode(',', $matches);
                } else {
                    $keywords = strtolower($product->category->title ?? 'fashion');
                }
                
                for ($i = 1; $i <= 5; $i++) {
                    try {
                        // Use loremflickr with a unique lock to get distinct images
                        $imageUrl = "https://loremflickr.com/800/1000/{$keywords}/all?lock=" . ($product->id * 10 + $i);
                        $product->addMediaFromUrl($imageUrl)
                                ->usingFileName("product-{$product->id}-{$i}.jpg")
                                ->toMediaCollection('product_images');
                    } catch (\Exception $e) {
                        \Illuminate\Support\Facades\Log::error("Failed to add media to product {$product->id}: " . $e->getMessage());
                    }
                }
            }
        }
    }
}
