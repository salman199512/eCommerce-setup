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
    $category    = $product->category->title ?? 'Apparel';
    $title       = $product->title ?? '';
    $price       = $product->price ?? rand(499, 1499);
    $oldPrice    = $product->mrp ?? ($price + rand(200, 500));
    $foods       = ['Silk Flowy Dress','Urban Denim Jacket','Classic White Tee','Luxury Leather Belt','Velvet Evening Gown','Designer Sunglasses','Premium Chinos','Wool Blend Coat','Minimalist Sneakers','Cotton Oxford Shirt'];
    $title       = $title ?: $foods[($stIdx - 1) % count($foods)];
    $imageUrl    = $product->avatar_url ?? 'https://images.unsplash.com/photo-'.([
        '1515886657613-9f3515b0c78f', // 1
        '1539109136881-3be061094fed', // 2
        '1551488831-00ddcb6c6bd3', // 3
        '1496747611176-843222e1e57c', // 4
        '1434389677669-e08b4cac3105', // 5
        '1549298916-b41d501d3772', // 6
        '1516762689617-e1cffcef479d', // 7
        '1524380365022-47c18598788c', // 8
        '1525507119028-ed4c629a60a3', // 9
        '1503342392332-683a4537380a', // 10
    ][($stIdx - 1) % 10]).'?auto=format&fit=crop&w=400&q=80';
    $secondImage = 'https://images.unsplash.com/photo-'.([
        '1485462537746-965f33f7f6a7',
        '1578932750294-f5075e85f44a',
        '1562157873-818bc0726f68',
        '1512436991641-6745cdb1723f',
        '1490481651871-ab68de25d43d',
    ][($stIdx - 1) % 5]).'?auto=format&fit=crop&w=400&q=80';
    $category    = ['Women','Men','Accessories','Collections','Outerwear'][($stIdx - 1) % 5];
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
                    <span class="price-current">₹{{ number_format($displayPrice, 2) }}</span>
                    @if($originalPrice > $displayPrice)
                    <span class="price-old">₹{{ number_format($originalPrice, 2) }}</span>
                    @endif
                @elseif(!$product)
                    <span class="price-current">₹{{ number_format($price, 2) }}</span>
                    <span class="price-old">₹{{ number_format($oldPrice, 2) }}</span>
                @else
                    <span style="font-size:.72rem;font-weight:700;color:var(--gray-400);">Out of Stock</span>
                @endif
            </div>

{{--            @if($product && $product->variants->isNotEmpty())--}}
{{--            <button class="card-atc-btn" onclick="addToCart({{ $product->id }})">--}}
{{--                <i class="fas fa-plus" style="font-size:.7rem;"></i> Add--}}
{{--            </button>--}}
{{--            @elseif(!$product)--}}
{{--            <button class="card-atc-btn">--}}
{{--                <i class="fas fa-plus" style="font-size:.7rem;"></i> Add--}}
{{--            </button>--}}
{{--            @endif--}}
        </div>
    </div>
</div>
