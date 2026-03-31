{{-- ══════════════════════════
     FreshMart Product Card
══════════════════════════ --}}
@php
if ($product) {
    $imageUrl    = $product->avatar_url ?: 'https://images.unsplash.com/photo-1606787366850-de6330128bfc?auto=format&fit=crop&w=600&q=80';
    $secondImage = $product->media->count() > 1 ? $product->media[1]->getUrl() : $imageUrl;
    $title       = $product->title;
    $category    = $product->category->title ?? 'Grocery';
    $url         = route('products.single', $product->slug);
    $isNew       = $product->is_new_arrival;
    $hasDiscount = $product->discount > 0 || ($product->variants->count() > 0 && $product->variants->min('discount') > 0);
} else {
    $stIdx       = $static_index ?? 1;
    $foods       = ['Organic Apples','Fresh Milk','Free Range Eggs','Whole Grain Bread','Baby Spinach','Greek Yogurt','Avocados','Cherry Tomatoes','Wild Salmon','Almond Butter'];
    $imgs        = ['1619566636213-aab0a0ce7b31','1567306226416-28f0efdc88ce','1618512496248-a4a64ce0c8bb','1586201375761-83865001e31c','1574316077139-f0beb48c8fdd','1559181567-c3190b5c7791','1523049673857-eb18f1dea2cc','1592924357228-91a4daadcfea','1535262412227-85541e910204','1508061253366-f7da158b6d46'];
    $i           = ($stIdx - 1) % count($imgs);
    $imageUrl    = "https://images.unsplash.com/photo-{$imgs[$i]}?auto=format&fit=crop&w=600&q=80";
    $secondImage = $imageUrl;
    $title       = $foods[($stIdx - 1) % count($foods)] . ' — Premium';
    $category    = ['Fruits','Dairy','Bakery','Produce','Seafood'][($stIdx - 1) % 5];
    $url         = '#';
    $isNew       = $stIdx % 3 == 0;
    $hasDiscount = $stIdx % 4 == 0;
}
@endphp

<div class="product-card">
    <!-- Image Area -->
    <div class="product-card-img-wrap">
        <a href="{{ $url }}">
            <img src="{{ $imageUrl }}" alt="{{ $title }}" class="product-card-img" loading="lazy">
            <img src="{{ $secondImage }}" alt="{{ $title }}" class="product-card-img-alt" loading="lazy">
        </a>

        <!-- Badges -->
        <div class="product-card-badges">
            @if($isNew)
            <span class="badge badge-green">New</span>
            @endif
            @if($hasDiscount)
            <span class="badge badge-orange discount-pct" style="display:none;">-0%</span>
            @endif
        </div>

        <!-- Hover Actions -->
        <div class="product-card-actions">
            <button class="quick-add-btn" onclick="addToCart({{ $product->id ?? 0 }})" title="Add to Cart">
                <i class="fas fa-cart-plus"></i>
            </button>
            <button class="wishlist-btn-card {{ $product && auth()->check() && auth()->user()->wishlists()->where('product_id', $product->id)->exists() ? 'active' : '' }}"
                    onclick="toggleWishlist({{ $product->id ?? 0 }}, this)" title="Add to Wishlist">
                <i class="{{ $product && auth()->check() && auth()->user()->wishlists()->where('product_id', $product->id)->exists() ? 'fas' : 'far' }} fa-heart"></i>
            </button>
            <a href="{{ $url }}" class="wishlist-btn-card" title="Quick View" style="text-decoration:none;">
                <i class="fas fa-eye"></i>
            </a>
        </div>
    </div>

    <!-- Card Body -->
    <div class="product-card-body">
        <div class="product-card-category">{{ $category }}</div>

        <a href="{{ $url }}" class="product-card-name">{{ $title }}</a>

        <!-- Stars -->
        <div class="star-rating">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
            <i class="fas fa-star"></i><i class="far fa-star"></i>
            <span class="count">({{ rand(12, 180) }})</span>
        </div>

        <div class="product-card-footer">
            <div class="product-price">
                @if($product && $product->variants->isNotEmpty())
                    @php
                        $firstVariant = $product->variants->first();
                        $displayPrice = $firstVariant->final_price ?? $firstVariant->price;
                        $originalPrice = $firstVariant->price;
                    @endphp
                    <span class="price-current">${{ number_format($displayPrice, 2) }}</span>
                    @if($originalPrice > $displayPrice)
                    <span class="price-old">${{ number_format($originalPrice, 2) }}</span>
                    @endif
                @elseif(!$product)
                    <span class="price-current">${{ number_format(rand(2, 25) + rand(0,99)/100, 2) }}</span>
                @else
                    <span style="font-size:.72rem;font-weight:700;color:var(--gray-400);">Out of Stock</span>
                @endif
            </div>

            @if($product && $product->variants->isNotEmpty())
            <button class="card-atc-btn" onclick="addToCart({{ $product->id }})">
                <i class="fas fa-plus" style="font-size:.7rem;"></i> Add
            </button>
            @elseif(!$product)
            <button class="card-atc-btn">
                <i class="fas fa-plus" style="font-size:.7rem;"></i> Add
            </button>
            @endif
        </div>
    </div>
</div>
