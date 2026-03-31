@extends('frontend.layouts.master')

@section('meta_title', $product->meta_title ?? $product->title)
@section('meta_description', $product->meta_description)
@section('meta_keywords', $product->meta_keywords)

@section('content')

<!-- Breadcrumb Area -->
<div class="container" style="padding-top:40px;">
    <nav class="shop-breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="separator">/</span>
        <a href="{{ route('products', ['category' => $product->category->slug]) }}">{{ $product->category->title }}</a>
        <span class="separator">/</span>
        <span class="current">{{ $product->title }}</span>
    </nav>
</div>

<div class="container section-spacing">
    <div class="grid-12 items-start">

        <!-- Left Column: Gallery (Sticky-ish) -->
        <div class="col-span-7 space-y-8">
            <div class="grid-12 gap-24">
                <!-- Thumbnails -->
                <div class="col-span-2 flex flex-col gap-12 overflow-x-auto md:overflow-visible pb-4 md:pb-0 scrollbar-hide">
                    @foreach($product->media as $media)
                    <button class="w-full aspect-square border border-gray-100 hover:border-black rounded-lg overflow-hidden transition-all duration-300 focus:outline-none focus:border-black thumbnail-btn flex-shrink-0 bg-gray-50"
                            onclick="changeImage('{{ $media->getUrl() }}', this)" style="padding:0;">
                        <img src="{{ $media->getUrl() }}" class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>

                <!-- Main Display -->
                <div class="col-span-10">
                    <div class="relative aspect-[4/5] bg-gray-50 rounded-[2rem] overflow-hidden group shadow-sm border border-gray-50">
                        <img id="main-product-image" src="{{ $product->avatar_url }}" alt="{{ $product->title }}"
                             class="w-full h-full object-cover transform transition-transform duration-1000 scale-100 group-hover:scale-105 cursor-zoom-in">

                        <div class="absolute top-6 left-6 z-10 flex flex-col gap-3">
                            @if($product->is_new_arrival)
                                <span class="bg-black text-white text-[8px] font-bold uppercase px-4 py-2 rounded-full tracking-premium shadow-xl">New Arrival</span>
                            @endif
                            <span id="discount-badge" class="badge-vibrant shadow-xl" style="display: none;">-0%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Info (Sticky) -->
        <div class="col-span-5" style="position:sticky;top:120px;">
            <div class="mb-4">
                <span style="color:var(--green-primary);font-size:0.7rem;font-weight:800;text-transform:uppercase;letter-spacing:0.15em;margin-bottom:12px;display:block;">{{ $product->category->title }} FRESH SELECTION</span>
                <h1 style="font-size:2.8rem;font-weight:900;margin-bottom:24px;line-height:1.1;text-transform:uppercase;letter-spacing:-0.04em;color:var(--gray-900);">{{ $product->title }}</h1>
                <div class="flex items-center gap-16 mb-40">
                    <div class="flex items-center gap-12">
                        <span id="product-price" style="font-size:2.5rem;font-weight:900;color:black;letter-spacing:-0.02em;">$0.00</span>
                        <span id="product-old-price" style="font-size:1.2rem;color:var(--gray-300);text-decoration:line-through;font-weight:600;display:none;">$0.00</span>
                    </div>
                </div>

                <div class="flex items-center gap-12 mb-12">
                    <div class="flex items-center gap-8 bg-green-soft text-green p-16 rounded-full border border-green-light" style="padding:4px 12px;">
                        <div class="w-1.5 h-1.5 rounded-full" style="background:var(--green-primary);width:6px;height:6px;"></div>
                        <span style="font-size:0.6rem;text-transform:uppercase;font-weight:900;letter-spacing:0.1em;">In Stock</span>
                    </div>
                    <div class="flex items-center gap-8">
                        <div class="flex text-yellow-primary" style="font-size:0.65rem;gap:2px;">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star text-muted"></i>
                        </div>
                        <span style="font-size:0.65rem;text-transform:uppercase;font-weight:800;letter-spacing:0.15em;color:var(--gray-400);">(4.8/5)</span>
                    </div>
                </div>

                @if($product->is_tax_included)
                <p style="font-size:0.6rem;color:var(--gray-400);font-weight:800;text-transform:uppercase;letter-spacing:0.15em;margin-bottom:16px;">Tax included. Shipping calculated at checkout.</p>
                @else
                <p style="font-size:0.6rem;color:var(--gray-400);font-weight:800;text-transform:uppercase;letter-spacing:0.15em;margin-bottom:40px;">Shipping calculated at checkout.</p>
                @endif

                <div class="bg-gray-50 rounded-xl mb-32 border border-gray-100" style="padding:24px;">
                    <div style="font-size:0.85rem;line-height:1.7;color:var(--gray-600);font-weight:600;">
                        <p class="m-0" style="margin-bottom:12px;">
                            {!! strip_tags($product->description) !!}
                        </p>
                        <a href="#details-tabs" style="color:var(--green-primary);font-weight:900;border-bottom:1.5px solid var(--green-light);text-transform:uppercase;font-size:0.7rem;letter-spacing:0.1em;">Read Full Story</a>
                    </div>
                </div>
            </div>

            <form action="{{ route('cart.add') }}" method="POST" id="add-to-cart-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="variant_id" id="selected-variant-id">

                <!-- Attribute Groups -->
                @php $groupedAttributes = $product->attributes->groupBy('attribute_group_id'); @endphp
                @if($groupedAttributes->isNotEmpty())
                    @foreach($groupedAttributes as $groupId => $attributes)
                        @php $groupLabel = \App\Models\AttributeGroup::find($groupId)->title ?? 'Select Option'; @endphp
                        <div class="mb-24">
                            <h4 style="font-size:0.6rem;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-400);margin-bottom:12px;">{{ $groupLabel }}</h4>
                            <div class="flex flex-wrap gap-8">
                                @foreach($attributes->unique('id') as $attr)
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="attribute[{{ $groupId }}]" value="{{ $attr->id }}"
                                           class="sr-only attribute-selector peer" data-group="{{ $groupId }}"
                                           {{ $product->variants->first()->attributes->contains($attr->id) ? 'checked' : '' }} required>
                                    <span class="inline-flex items-center justify-center bg-white border border-gray-100 rounded-lg text-black transition-all duration-300 hover:border-black peer-checked:bg-black peer-checked:text-white peer-checked:border-black"
                                          style="min-width:48px;height:40px;padding:0 16px;font-size:0.7rem;font-weight:800;text-transform:uppercase;letter-spacing:0.1em;">
                                        {{ $attr->title }}
                                    </span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="flex flex-wrap gap-12 mb-40">
                    <!-- Qty -->
                    <div style="display:flex;align-items:center;background:var(--gray-50);border:1px solid var(--gray-100);border-radius:var(--radius-full);padding:4px 12px;height:48px;">
                        <button type="button" onclick="decrementQty()" style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;color:var(--gray-400);border:none;background:none;cursor:pointer;">&minus;</button>
                        <input type="text" id="quantity" name="quantity" value="1" readonly
                               style="width:40px;text-align:center;font-size:0.9rem;font-weight:700;color:black;background:transparent;border:none;">
                        <button type="button" onclick="incrementQty()" style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;color:var(--gray-400);border:none;background:none;cursor:pointer;">&plus;</button>
                    </div>

                    <!-- Add to Cart -->
                    <button type="submit" id="add-to-cart-btn" class="fm-btn-vibrant" style="flex:1;min-width:200px;height:48px;">
                        <i class="fas fa-shopping-basket" style="font-size:1rem;margin-right:8px;"></i>
                        <span>Add To Cart</span>
                    </button>

                    <!-- Wishlist -->
                    <button type="button" onclick="addToWishlist({{ $product->id }})" 
                            style="width:48px;height:48px;display:flex;align-items:center;justify-content:center;border:1.5px solid var(--gray-100);background:white;color:var(--gray-400);border-radius:var(--radius-lg);transition:var(--trans-base);cursor:pointer;"
                            class="wishlist-btn-{{ $product->id }} shadow-sm">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
            </form>

            <!-- Trust & Info -->
            <div class="pt-24 border-t border-gray-100 mt-12" style="border-top:1px solid var(--gray-100);">
                <div class="grid-2 gap-24 mb-32">
                    <div>
                        <span style="font-size:0.55rem;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-300);display:block;margin-bottom:6px;">Availability</span>
                        <span style="font-size:0.7rem;font-weight:900;color:var(--green-primary);text-transform:uppercase;letter-spacing:0.1em;">In Stock</span>
                    </div>
                    <div style="text-align:right;">
                        <span style="font-size:0.55rem;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-300);display:block;margin-bottom:6px;">Archive SKU</span>
                        <span id="product-sku" style="font-size:0.7rem;font-weight:900;color:black;text-transform:uppercase;letter-spacing:0.1em;">SFD-{{ strtoupper(substr($product->title, 0, 3)) }}</span>
                    </div>
                </div>

                <div class="flex items-center justify-between border-y border-gray-50 py-12 mb-24" style="border-top:1px solid var(--gray-50);border-bottom:1px solid var(--gray-50);padding:12px 0;">
                    <div class="flex items-center gap-12">
                        <div style="width:36px;height:36px;background:var(--gray-50);border-radius:var(--radius-full);display:flex;align-items:center;justify-content:center;color:black;">
                            <i class="fa fa-shield-alt" style="font-size:0.65rem;"></i>
                        </div>
                        <span style="font-size:0.65rem;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;color:black;">Authenticity Guaranteed</span>
                    </div>
                    <div class="flex gap-12" style="opacity:0.3;filter:grayscale(1);">
                        <i class="fab fa-cc-visa" style="font-size:1.2rem;"></i>
                        <i class="fab fa-cc-mastercard" style="font-size:1.2rem;"></i>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <span style="font-size:0.65rem;font-weight:900;text-transform:uppercase;letter-spacing:0.15em;color:var(--gray-400);">Share Piece</span>
                    <div class="flex gap-12">
                        <a href="#" style="color:var(--gray-300);font-size:0.8rem;" class="hover:text-black"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" style="color:var(--gray-300);font-size:0.8rem;" class="hover:text-black"><i class="fab fa-twitter"></i></a>
                        <a href="#" style="color:var(--gray-300);font-size:0.8rem;" class="hover:text-black"><i class="fab fa-pinterest-p"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Accordion: Description / Logistics & Care / Reviews -->
    <div class="mt-24 border-t border-gray-100" x-data="{ open: 'description' }">

        <!-- Description (open by default) -->
        <div class="border-b border-gray-100">
            <button @click="open = open === 'description' ? null : 'description'"
                    style="width:100%;display:flex;align-items:center;justify-content:space-between;padding:32px 8px;border:none;background:none;cursor:pointer;" class="group">
                <div style="text-align:left;">
                    <span style="color:var(--green-primary);font-size:0.65rem;font-weight:800;text-transform:uppercase;letter-spacing:0.2em;display:block;margin-bottom:4px;">The Details</span>
                    <h3 style="font-size:1.5rem;font-weight:700;text-transform:uppercase;letter-spacing:-0.02em;color:black;">Product Description</h3>
                </div>
                <div style="width:40px;height:40px;border-radius:var(--radius-full);border:2px solid var(--gray-200);display:flex;align-items:center;justify-content:center;transition:var(--trans-base);"
                     :class="open === 'description' ? 'bg-black border-black' : ''">
                    <i class="fas fa-chevron-down" style="font-size:0.75rem;"
                       :class="open === 'description' ? 'text-white' : 'text-gray-400'"></i>
                </div>
            </button>
            <div x-show="open === 'description'"
                 x-transition:enter="transition ease-out duration-400"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="px-2 pb-10">
                <div class="max-w-4xl">
                    <div class="text-gray-600 leading-relaxed text-sm font-medium text-left space-y-4 prose max-w-none">
                        {!! $product->description !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Logistics & Care (collapsed by default) -->
        <div class="border-b border-gray-100">
            <button @click="open = open === 'logistics' ? null : 'logistics'"
                    style="width:100%;display:flex;align-items:center;justify-content:space-between;padding:32px 8px;border:none;background:none;cursor:pointer;" class="group">
                <div style="text-align:left;">
                    <span style="color:var(--orange-primary);font-size:0.65rem;font-weight:800;text-transform:uppercase;letter-spacing:0.2em;display:block;margin-bottom:4px;">Delivery & Care</span>
                    <h3 style="font-size:1.5rem;font-weight:700;text-transform:uppercase;letter-spacing:-0.02em;color:black;">Logistics & Care</h3>
                </div>
                <div style="width:40px;height:40px;border-radius:var(--radius-full);border:2px solid var(--gray-200);display:flex;align-items:center;justify-content:center;transition:var(--trans-base);"
                     :class="open === 'logistics' ? 'bg-black border-black' : ''">
                    <i class="fas fa-chevron-down" style="font-size:0.75rem;"
                       :class="open === 'logistics' ? 'text-white' : 'text-gray-400'"></i>
                </div>
            </button>
            <div x-show="open === 'logistics'"
                 x-transition:enter="transition ease-out duration-400"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="px-2 pb-10" style="display:none;">
                @if($product->logistics_care)
                    <div class="prose max-w-none text-gray-600 leading-relaxed text-sm font-medium max-w-4xl">
                        {!! $product->logistics_care !!}
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-gray-500">
                        <div class="text-center p-8 bg-gray-50 rounded-3xl border border-gray-100">
                            <div class="w-14 h-14 bg-black rounded-2xl flex items-center justify-center mx-auto mb-5">
                                <i class="fas fa-truck text-white text-xl"></i>
                            </div>
                            <h5 class="text-[11px] font-black uppercase tracking-widest text-black mb-3">Fast Transit</h5>
                            <p class="text-[12px] leading-relaxed">Standard delivery within 3-5 business days across global hubs.</p>
                        </div>
                        <div class="text-center p-8 bg-gray-50 rounded-3xl border border-gray-100">
                            <div class="w-14 h-14 bg-black rounded-2xl flex items-center justify-center mx-auto mb-5">
                                <i class="fas fa-box text-white text-xl"></i>
                            </div>
                            <h5 class="text-[11px] font-black uppercase tracking-widest text-black mb-3">Premium Wrapping</h5>
                            <p class="text-[12px] leading-relaxed">Every item arrives in our signature minimalist archive box.</p>
                        </div>
                        <div class="text-center p-8 bg-gray-50 rounded-3xl border border-gray-100">
                            <div class="w-14 h-14 bg-black rounded-2xl flex items-center justify-center mx-auto mb-5">
                                <i class="fas fa-undo text-white text-xl"></i>
                            </div>
                            <h5 class="text-[11px] font-black uppercase tracking-widest text-black mb-3">Easy Returns</h5>
                            <p class="text-[12px] leading-relaxed">Complimentary returns within 14 days for all unworn pieces.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Reviews (collapsed by default) -->
        <div class="border-b border-gray-100">
            <button @click="open = open === 'reviews' ? null : 'reviews'"
                    class="w-full flex items-center justify-between py-8 px-2 group">
                <div class="text-left">
                    <span class="text-[#f59e0b] text-[10px] font-black uppercase tracking-[0.25em] block mb-1">Client Voices</span>
                    <h3 class="text-2xl md:text-3xl font-black uppercase tracking-tight text-black group-hover:text-[#f59e0b] transition-colors">Reviews</h3>
                </div>
                <div class="ml-6 shrink-0 w-10 h-10 rounded-full border-2 border-gray-200 flex items-center justify-center transition-all duration-500 group-hover:border-black"
                     :class="open === 'reviews' ? 'bg-black border-black rotate-180' : ''">
                    <i class="fas fa-chevron-down text-xs transition-all duration-500"
                       :class="open === 'reviews' ? 'text-white' : 'text-gray-400'"></i>
                </div>
            </button>
            <div x-show="open === 'reviews'"
                 x-transition:enter="transition ease-out duration-400"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="px-2 pb-10" style="display:none;">
                <div class="bg-gray-50 p-14 rounded-3xl border border-gray-100 text-center max-w-2xl mx-auto">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl shadow-black/5">
                        <i class="fas fa-star text-2xl text-gray-200"></i>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-4">Experience has no substitute</p>
                    <h4 class="text-xl font-black text-black mb-8 uppercase tracking-tighter">Be the first to review</h4>
                    <button class="btn-premium">
                        Write a Review
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- You May Also Like -->
    <div style="margin-top:80px;padding-top:80px;border-top:1px solid var(--border-light);">
        <div style="text-align:center;margin-bottom:60px;">
            <span style="color:var(--green-primary);font-size:0.75rem;font-weight:900;text-transform:uppercase;letter-spacing:0.3em;display:block;margin-bottom:12px;">Fresh Selection</span>
        <h2 style="font-size:2.5rem;font-weight:900;text-transform:uppercase;letter-spacing:-0.04em;line-height:1.1;color:var(--gray-900);">You May Also Like</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @if(isset($relatedProducts) && $relatedProducts->isNotEmpty())
                @foreach($relatedProducts as $related)
                    @include('frontend.components.product-card', ['product' => $related])
                @endforeach
            @else
                @php $fallbackProducts = \App\Models\Product::where('id', '!=', $product->id)->active()->take(4)->get(); @endphp
                @foreach($fallbackProducts as $related)
                    @include('frontend.components.product-card', ['product' => $related])
                @endforeach
            @endif
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const variants = {!! json_encode($product->variants->map(function($v) {
        return [
            'id' => $v->id,
            'price' => $v->price,
            'discount' => $v->discount,
            'final_price' => $v->final_price,
            'sku' => $v->sku,
            'attributes' => $v->attributes->map(function($a) {
                return ['group_id' => $a->pivot->attribute_group_id, 'attribute_id' => $a->id];
            })
        ];
    })) !!};

    const attributeSelectors = document.querySelectorAll('.attribute-selector');
    const addToCartBtn = document.getElementById('add-to-cart-btn');
    const priceEl = document.getElementById('product-price');
    const oldPriceEl = document.getElementById('product-old-price');
    const skuEl = document.getElementById('product-sku');
    const variantInput = document.getElementById('selected-variant-id');
    const discountBadge = document.getElementById('discount-badge');

    window.changeImage = function(url, btn) {
        const mainImg = document.getElementById('main-product-image');
        mainImg.style.opacity = '0';
        setTimeout(() => {
            mainImg.src = url;
            mainImg.style.opacity = '1';
        }, 150);

        document.querySelectorAll('.thumbnail-btn').forEach(b => b.classList.remove('border-black'));
        btn.classList.add('border-black');
    }

    window.incrementQty = function() {
        let el = document.getElementById('quantity');
        el.value = parseInt(el.value) + 1;
    }
    window.decrementQty = function() {
        let el = document.getElementById('quantity');
        if(parseInt(el.value) > 1) el.value = parseInt(el.value) - 1;
    }

    attributeSelectors.forEach(radio => {
        radio.addEventListener('change', function() {
            checkVariantMatch();
        });
    });

    function checkVariantMatch() {
        const selected = {};
        let allSelected = true;
        const groups = [...new Set([...attributeSelectors].map(el => el.dataset.group))];

        groups.forEach(groupId => {
            const checked = document.querySelector(`input[name="attribute[${groupId}]"]:checked`);
            if (checked) selected[groupId] = parseInt(checked.value);
            else allSelected = false;
        });

        if (!allSelected) {
            addToCartBtn.disabled = true;
            addToCartBtn.querySelector('span').innerText = 'Select Options';
            return;
        }

        const matchedVariant = variants.find(variant => {
            return Object.keys(selected).every(groupId => {
                return variant.attributes.some(attr => attr.group_id == groupId && attr.attribute_id == selected[groupId]);
            });
        });

        if (matchedVariant) {
            priceEl.innerText = '$' + parseFloat(matchedVariant.final_price || matchedVariant.price).toFixed(2);
            if(matchedVariant.discount > 0) {
                oldPriceEl.innerText = '$' + parseFloat(matchedVariant.price).toFixed(2);
                oldPriceEl.style.display = 'block';
                discountBadge.innerText = '-' + parseInt(matchedVariant.discount) + '%';
                discountBadge.style.display = 'block';
            } else {
                oldPriceEl.style.display = 'none';
                discountBadge.style.display = 'none';
            }
            skuEl.innerText = matchedVariant.sku || 'N/A';
            variantInput.value = matchedVariant.id;
            addToCartBtn.disabled = false;
            addToCartBtn.querySelector('span').innerText = 'Add To Cart';
        } else {
            addToCartBtn.disabled = true;
            addToCartBtn.querySelector('span').innerText = 'Unavailable';
            priceEl.innerText = 'Unavailable';
        }
    }

    $('#add-to-cart-form').on('submit', function(e) {
        e.preventDefault();
        const variantId = $('#selected-variant-id').val();
        const qty = $('#quantity').val();

        if (!variantId) {
            toastr.warning('Please select all options.');
            return;
        }

        $.ajax({
            url: "{{ route('cart.add') }}",
            type: "POST",
            data: {
                variant_id: variantId,
                quantity: qty,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('.cart-count-global').text(response.totalQty);
                    $('.cart-items-count').text(response.cartCount);
                }
            }
        });
    });

    window.addToWishlist = function(id) {
        @guest
            toastr.info('Please login to add items to your wishlist.');
            return;
        @endguest

        $.ajax({
            url: "{{ route('wishlist.add') }}",
            type: "POST",
            data: {
                product_id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('.wishlist-btn-' + id).find('i').removeClass('far').addClass('fas text-red-600');
                } else {
                    toastr.warning(response.message);
                }
            }
        });
    }

    checkVariantMatch();
</script>
@endpush
