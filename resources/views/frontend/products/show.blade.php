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
            <div class="mb-10">
                <span class="text-red-600 text-[11px] font-bold uppercase tracking-cinematic mb-4 block">{{ $product->category->title }} Collection</span>
                <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight tracking-tighter text-black uppercase">{{ $product->title }}</h1>
                
                <div class="flex items-center gap-6 mb-6">
                    <div class="flex items-baseline gap-4">
                        <span id="product-price" class="text-3xl font-bold text-black tracking-tight">$0.00</span>
                        <span id="product-old-price" class="text-lg text-gray-300 line-through font-medium" style="display: none;">$0.00</span>
                    </div>
                </div>

                <div class="flex items-center gap-4 mb-8">
                    <div class="flex items-center gap-1.5 bg-green-50 text-green-700 px-3 py-1 rounded-full border border-green-100">
                        <i class="fas fa-check-circle text-[10px]"></i>
                        <span class="text-[10px] uppercase font-bold tracking-premium">In Stock</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="flex text-yellow-400 text-[10px]">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-[10px] uppercase font-bold tracking-premium text-gray-400">(4.8/5)</span>
                    </div>
                </div>

                @if($product->is_tax_included)
        <p class="text-[10px] text-gray-400 font-medium uppercase tracking-widest mb-10 italic">Tax included. Shipping calculated at checkout.</p>
        @else
        <p class="text-[10px] text-gray-400 font-medium uppercase tracking-widest mb-10 italic">Shipping calculated at checkout.</p>
        @endif

                <div class="bg-gray-50 p-6 rounded-3xl mb-10 border border-gray-100">
                    <p class="text-gray-500 text-sm leading-relaxed font-medium">
                        {!! \Illuminate\Support\Str::limit(strip_tags($product->description), 200) !!}
                        <a href="#details-tabs" class="text-black font-bold border-b-2 border-black ml-1">Details</a>
                    </p>
                </div>
            </div>

            <form action="{{ route('add-to-cart') }}" method="POST" id="add-to-cart-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="variant_id" id="selected-variant-id">

                <!-- Attribute Groups -->
                @php $groupedAttributes = $product->attributes->groupBy('attribute_group_id'); @endphp
                @if($groupedAttributes->isNotEmpty())
                    @foreach($groupedAttributes as $groupId => $attributes)
                        @php $groupLabel = \App\Models\AttributeGroup::find($groupId)->title ?? 'Select Option'; @endphp
                        <div class="mb-8">
                            <h4 class="text-[11px] font-bold uppercase tracking-premium text-black mb-4">{{ $groupLabel }}</h4>
                            <div class="flex flex-wrap gap-3">
                                @foreach($attributes->unique('id') as $attr)
                                <label class="relative group">
                                    <input type="radio" name="attribute[{{ $groupId }}]" value="{{ $attr->id }}" 
                                           class="sr-only attribute-selector" data-group="{{ $groupId }}" required>
                                    <span class="inline-block px-8 py-3 bg-white border border-gray-200 rounded-sm text-[10px] font-bold uppercase tracking-premium cursor-pointer transition-all duration-300 hover:border-black peer-checked:border-black peer-checked:bg-black peer-checked:text-white selector-label">
                                        {{ $attr->title }}
                                    </span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="flex gap-4 mb-10">
                    <!-- Qty -->
                    <div class="flex items-center px-4 py-3 bg-white border border-gray-200 rounded-sm">
                        <button type="button" onclick="decrementQty()" class="text-gray-400 hover:text-black transition-colors px-3 font-bold text-lg">&minus;</button>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" readonly 
                               class="w-8 text-center bg-transparent border-none text-xs font-bold focus:ring-0 text-black p-0">
                        <button type="button" onclick="incrementQty()" class="text-gray-400 hover:text-black transition-colors px-3 font-bold text-lg">&plus;</button>
                    </div>

                    <!-- Add to Cart -->
                    <button type="submit" id="add-to-cart-btn" 
                            class="flex-1 bg-black text-white px-8 py-4 text-[11px] font-bold uppercase tracking-premium transition-all duration-300 hover:bg-gray-800 disabled:bg-gray-400 disabled:cursor-not-allowed flex items-center justify-center gap-3 shadow-sm">
                        <i class="fas fa-shopping-bag text-sm"></i>
                        <span>Add To Cart</span>
                    </button>

                    <!-- Wishlist -->
                    <button type="button" class="w-14 h-14 flex items-center justify-center border border-gray-200 text-gray-400 hover:text-red-500 hover:bg-gray-50 transition-all duration-300 rounded-sm group">
                        <i class="far fa-heart group-hover:fas"></i>
                    </button>
                </div>
            </form>

            <!-- Trust & Info -->
            <div class="space-y-6 pt-10 border-t border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex flex-col gap-1">
                        <span class="text-[10px] font-bold uppercase tracking-premium text-gray-400">Availability:</span>
                        <span class="text-xs font-bold text-green-600">In Stock</span>
                    </div>
                    <div class="flex flex-col gap-1 text-right">
                        <span class="text-[10px] font-bold uppercase tracking-premium text-gray-400">SKU:</span>
                        <span id="product-sku" class="text-xs font-bold text-black uppercase">N/A</span>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-sm border border-dashed border-gray-200">
                    <div class="flex items-center gap-4 mb-4">
                        <i class="fas fa-shield-alt text-gray-400 text-lg"></i>
                        <span class="text-[10px] font-bold uppercase tracking-premium text-gray-700">Secured Payment Guarantee</span>
                    </div>
                    <div class="flex gap-4 grayscale opacity-40">
                        <i class="fab fa-cc-visa text-xl"></i>
                        <i class="fab fa-cc-mastercard text-xl"></i>
                        <i class="fab fa-cc-amex text-xl"></i>
                        <i class="fab fa-cc-paypal text-xl"></i>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <span class="text-[10px] font-bold uppercase tracking-premium text-gray-400">Share:</span>
                    <div class="flex gap-4">
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors"><i class="fab fa-facebook-f text-sm"></i></a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors"><i class="fab fa-twitter text-sm"></i></a>
                        <a href="#" class="text-gray-400 hover:text-red-600 transition-colors"><i class="fab fa-pinterest-p text-sm"></i></a>
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
            document.querySelectorAll(`input[name="${this.name}"]`).forEach(inp => {
                inp.nextElementSibling.classList.remove('bg-black', 'text-white', 'border-black');
                inp.nextElementSibling.classList.add('border-gray-100');
            });
            this.nextElementSibling.classList.add('bg-black', 'text-white', 'border-black');
            this.nextElementSibling.classList.remove('border-gray-100');
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
    checkVariantMatch();
</script>
@endpush
