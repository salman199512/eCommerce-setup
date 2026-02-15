@extends('frontend.layouts.master')

@section('meta_title', $product->meta_title ?? $product->title)
@section('meta_description', $product->meta_description)
@section('meta_keywords', $product->meta_keywords)

@section('content')

<!-- Breadcrumb Area -->
<div class="bg-white border-b border-gray-100 py-6">
    <div class="container mx-auto px-4">
        <nav class="flex text-[11px] font-bold uppercase tracking-premium text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-black transition-colors">Home</a>
            <span class="mx-3 opacity-30">/</span>
            <a href="{{ route('products', ['category' => $product->category->slug]) }}" class="hover:text-black transition-colors">{{ $product->category->title }}</a>
            <span class="mx-3 opacity-30">/</span>
            <span class="text-black font-bold">{{ $product->title }}</span>
        </nav>
    </div>
</div>

<div class="container mx-auto px-4 py-12 md:py-24">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">

        <!-- Left Column: Gallery (Sticky-ish) -->
        <div class="lg:col-span-7 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                <!-- Thumbnails -->
                <div class="md:col-span-2 order-2 md:order-1 flex md:flex-col gap-4 overflow-x-auto md:overflow-visible pb-4 md:pb-0 scrollbar-hide">
                    @foreach($product->media as $media)
                    <button class="w-20 h-20 md:w-full aspect-square border border-gray-100 hover:border-black rounded-lg overflow-hidden transition-all duration-300 focus:outline-none focus:border-black thumbnail-btn flex-shrink-0 bg-gray-50"
                            onclick="changeImage('{{ $media->getUrl() }}', this)">
                        <img src="{{ $media->getUrl() }}" class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>

                <!-- Main Display -->
                <div class="md:col-span-10 order-1 md:order-2">
                    <div class="relative aspect-[4/5] bg-gray-50 rounded-[2.5rem] overflow-hidden group shadow-sm border border-gray-50">
                        <img id="main-product-image" src="{{ $product->avatar_url }}" alt="{{ $product->title }}"
                             class="w-full h-full object-cover transform transition-transform duration-1000 scale-100 group-hover:scale-105 cursor-zoom-in">

                        <div class="absolute top-6 left-6 z-10 flex flex-col gap-3">
                            @if($product->is_new_arrival)
                                <span class="bg-black text-white text-[8px] font-bold uppercase px-4 py-2 rounded-full tracking-premium shadow-xl">New Arrival</span>
                            @endif
                            <span id="discount-badge" class="bg-red-600 text-white text-[8px] font-bold uppercase px-4 py-2 rounded-full tracking-premium shadow-xl" style="display: none;">-0%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Info (Sticky) -->
        <div class="lg:col-span-5 lg:sticky lg:top-32">
            <div class="mb-4">
                <span class="text-red-600 text-[12px] font-black uppercase tracking-[0.3em] mb-6 block">{{ $product->category->title }} ARCHIVE</span>
                <h1 class="text-5xl md:text-6xl font-black mb-8 leading-[0.9] tracking-[-0.04em] text-black uppercase">{{ $product->title }}</h1>

                <div class="flex items-center gap-8 mb-10">
                    <div class="flex items-baseline gap-6">
                        <span id="product-price" class="text-5xl font-black text-black tracking-tighter leading-none">$0.00</span>
                        <span id="product-old-price" class="text-xl text-gray-300 line-through font-bold tracking-tighter" style="display: none;">$0.00</span>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-6 mb-10">
                    <div class="flex items-center gap-2 bg-emerald-50 text-emerald-600 px-4 py-1.5 rounded-full border border-emerald-100/50 shadow-sm shadow-emerald-100/20">
                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                        <span class="text-[10px] uppercase font-black tracking-widest">In Stock</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex text-yellow-400 text-[9px] gap-0.5">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star text-gray-200"></i>
                        </div>
                        <span class="text-[10px] uppercase font-black tracking-widest text-gray-400">(4.8/5)</span>
                    </div>
                </div>

                @if($product->is_tax_included)
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.15em] mb-4">Tax included. Shipping calculated at checkout.</p>
                @else
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.15em] mb-12">Shipping calculated at checkout.</p>
                @endif

                <div class="bg-gray-50/50 px-0 py-2 rounded-[2.5rem] mb-3 border border-gray-100 shadow-sm">
                    <div class="text-gray-500 text-[13px] leading-relaxed font-black uppercase tracking-wider space-y-1">
                        <p class="line-clamp-3 m-0">
                            {!! strip_tags($product->description) !!}
                        </p>
                        <a href="#details-tabs" class="inline-block text-black font-black border-b-2 border-black pb-0.5 hover:text-red-600 hover:border-red-600 transition-all duration-500">DETAILS</a>
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
                        <div class="mb-8">
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-4">{{ $groupLabel }}</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($attributes->unique('id') as $attr)
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="attribute[{{ $groupId }}]" value="{{ $attr->id }}"
                                           class="sr-only attribute-selector peer" data-group="{{ $groupId }}"
                                           {{ $product->variants->first()->attributes->contains($attr->id) ? 'checked' : '' }} required>
                                    <span class="inline-flex items-center justify-center min-w-[3.5rem] h-11 px-4 bg-white border border-gray-100 rounded-xl text-[10px] font-black uppercase tracking-widest text-black transition-all duration-300 hover:border-black peer-checked:bg-black peer-checked:text-white peer-checked:border-black peer-checked:shadow-xl peer-checked:shadow-black/10">
                                        {{ $attr->title }}
                                    </span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="flex flex-wrap gap-4 mb-10">
                    <!-- Qty -->
                    <div class="flex items-center p-1 bg-gray-50 border border-gray-100 rounded-full shadow-inner h-14">
                        <button type="button" onclick="decrementQty()" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-black hover:bg-white hover:shadow-sm rounded-full transition-all font-black text-lg">&minus;</button>
                        <div class="w-12 h-10 flex items-center justify-center bg-white rounded-xl border border-gray-100 shadow-sm mx-1">
                            <input type="text" id="quantity" name="quantity" value="1" readonly
                                   class="w-full text-center bg-transparent border-none text-base font-black focus:ring-0 text-black p-0">
                        </div>
                        <button type="button" onclick="incrementQty()" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-black hover:bg-white hover:shadow-sm rounded-full transition-all font-black text-lg">&plus;</button>
                    </div>

                    <!-- Add to Cart -->
                    <button type="submit" id="add-to-cart-btn"
                            class="flex-1 min-w-[200px] h-14 bg-black text-white px-8 py-4 text-[11px] font-black uppercase tracking-widest transition-all duration-500 hover:bg-red-600 disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed flex items-center justify-center gap-3 shadow-xl shadow-black/10 rounded-2xl group">
                        <i class="fas fa-shopping-bag text-sm group-hover:scale-110 transition-transform"></i>
                        <span>Add To Cart</span>
                    </button>

                    <!-- Wishlist -->
                    <button type="button" onclick="addToWishlist({{ $product->id }})" class="w-14 h-14 flex items-center justify-center border border-gray-100 text-gray-400 hover:text-red-600 hover:bg-gray-50 transition-all duration-500 rounded-2xl group wishlist-btn-{{ $product->id }} shadow-sm">
                        <i class="far fa-heart group-hover:fas"></i>
                    </button>
                </div>
            </form>

            <!-- Trust & Info -->
            <div class="space-y-8 pt-0 border-t border-gray-100 mt-0">
                <div class="grid grid-cols-2 gap-12">
                    <div class="flex flex-col gap-2">
                        <span class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400">Availability</span>
                        <span class="text-[11px] font-black text-emerald-500 uppercase tracking-widest">In Stock</span>
                    </div>
                    <div class="flex flex-col gap-2 text-right">
                        <span class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400">Archive SKU</span>
                        <span id="product-sku" class="text-[11px] font-black text-black uppercase tracking-widest">SFD-{{ strtoupper(substr($product->title, 0, 3)) }}</span>
                    </div>
                </div>

                <div class="py-3 border-y border-gray-50 flex items-center justify-between group cursor-default">
                    <div class="flex items-center gap-6">
                        <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-black group-hover:bg-black group-hover:text-white transition-all duration-500">
                            <i class="fa fa-shield-alt text-xs"></i>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-black">Authenticity Guaranteed</span>
                    </div>
                    <div class="flex gap-4 opacity-20 grayscale hover:opacity-100 hover:grayscale-0 transition-all duration-500">
                        <i class="fab fa-cc-visa text-lg"></i>
                        <i class="fab fa-cc-mastercard text-lg"></i>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400">Share Piece</span>
                    <div class="flex gap-6">
                        <a href="#" class="text-gray-300 hover:text-black transition-all duration-500"><i class="fab fa-facebook-f text-xs"></i></a>
                        <a href="#" class="text-gray-300 hover:text-black transition-all duration-500"><i class="fab fa-twitter text-xs"></i></a>
                        <a href="#" class="text-gray-300 hover:text-black transition-all duration-500"><i class="fab fa-pinterest-p text-xs"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Area -->
    <div class="mt-32 border-t border-gray-100 pt-24" id="details-tabs" x-data="{ activeTab: 'description' }">
        <div class="flex flex-wrap justify-center gap-8 md:gap-16 mb-16 px-4">
            <button @click="activeTab = 'description'"
                    :class="activeTab === 'description' ? 'text-black border-black' : 'text-gray-300 border-transparent hover:text-gray-500'"
                    class="text-[11px] font-bold uppercase tracking-cinematic pb-6 border-b-2 transition-all">
                Product Analysis
            </button>
            <button @click="activeTab = 'shipping'"
                    :class="activeTab === 'shipping' ? 'text-black border-black' : 'text-gray-300 border-transparent hover:text-gray-500'"
                    class="text-[11px] font-bold uppercase tracking-cinematic pb-6 border-b-2 transition-all">
                Logistics & Care
            </button>
            <button @click="activeTab = 'reviews'"
                    :class="activeTab === 'reviews' ? 'text-black border-black' : 'text-gray-300 border-transparent hover:text-gray-500'"
                    class="text-[11px] font-bold uppercase tracking-cinematic pb-6 border-b-2 transition-all">
                Client Reviews (4)
            </button>
        </div>

        <div class="max-w-4xl mx-auto px-4">
            <!-- Description -->
            <div x-show="activeTab === 'description'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="prose max-w-none">
                <div class="text-gray-600 leading-relaxed text-sm font-medium text-left space-y-4">
                    {!! $product->description !!}
                </div>
            </div>

            <!-- Shipping -->
            <div x-show="activeTab === 'shipping'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="text-left" style="display: none;">
                @if($product->logistics_care)
                    <div class="prose max-w-none text-gray-600 leading-relaxed text-sm font-medium">
                        {!! $product->logistics_care !!}
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-gray-500 text-center">
                        <div>
                            <i class="fas fa-truck text-2xl mb-4 text-black"></i>
                            <h5 class="text-[11px] font-bold uppercase tracking-premium text-black mb-3">Fast Transit</h5>
                            <p class="text-[12px] leading-relaxed">Standard delivery within 3-5 business days across global hubs.</p>
                        </div>
                        <div>
                            <i class="fas fa-box text-2xl mb-4 text-black"></i>
                            <h5 class="text-[11px] font-bold uppercase tracking-premium text-black mb-3">Premium Wrapping</h5>
                            <p class="text-[12px] leading-relaxed">Every item arrives in our signature minimalist archive box.</p>
                        </div>
                        <div>
                            <i class="fas fa-undo text-2xl mb-4 text-black"></i>
                            <h5 class="text-[11px] font-bold uppercase tracking-premium text-black mb-3">Easy Returns</h5>
                            <p class="text-[12px] leading-relaxed">Complimentary returns within 14 days for all unworn pieces.</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Reviews -->
            <div x-show="activeTab === 'reviews'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="text-center" style="display: none;">
                <div class="bg-gray-50 p-12 rounded-sm border border-gray-100">
                    <p class="text-xs font-bold uppercase tracking-premium text-gray-400 mb-6">Experience has no substitute</p>
                    <h4 class="text-2xl font-bold text-black mb-8 uppercase tracking-tighter">Verified Satisfaction</h4>
                    <button class="bg-black text-white px-8 py-3 text-[10px] font-bold uppercase tracking-premium hover:bg-red-600 transition-colors">Write a Review</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="mt-48 pt-24 border-t border-gray-100">
        <div class="flex flex-col items-center mb-16 text-center">
            <span class="text-red-600 text-xs font-bold uppercase tracking-cinematic mb-4 block">Archive Selection</span>
            <h2 class="text-3xl md:text-5xl font-bold leading-tight text-black uppercase tracking-tighter">You May Also Like</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @if(isset($relatedProducts) && $relatedProducts->isNotEmpty())
                @foreach($relatedProducts as $related)
                    @include('frontend.components.product-card', ['product' => $related])
                @endforeach
            @else
                {{-- Fallback to some random products if related list is empty for demo --}}
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
