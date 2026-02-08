@extends('frontend.layouts.master')

@section('meta_title', $product->meta_title ?? $product->title)
@section('meta_description', $product->meta_description)
@section('meta_keywords', $product->meta_keywords)

@section('content')

<!-- Breadcrumb -->
<div class="bg-gray-100 py-4 mb-8">
    <div class="container mx-auto px-4">
        <ol class="list-reset flex text-gray-500 text-sm">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600">Home</a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="{{ route('products', ['category' => $product->category->slug]) }}" class="hover:text-blue-600">{{ $product->category->title }}</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-800 font-medium">{{ $product->title }}</li>
        </ol>
    </div>
</div>

<div class="container mx-auto px-4 mb-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <!-- Image Gallery -->
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Thumbnails (Vertical on desktop) -->
            <div class="hidden md:flex flex-col gap-4 w-24">
                 @foreach($product->media as $media)
                <button class="border border-gray-200 hover:border-blue-500 rounded overflow-hidden aspect-w-1 aspect-h-1 focus:outline-none focus:ring-2 focus:ring-blue-500 thumbnail-btn" onclick="changeImage('{{ $media->getUrl() }}')">
                    <img src="{{ $media->getUrl() }}" class="w-full h-full object-cover">
                </button>
                @endforeach
            </div>
            
            <!-- Main Image -->
            <div class="flex-1 bg-gray-50 rounded-lg overflow-hidden border border-gray-200 relative group">
                @php
                    $mainImage = $product->avatar_url;
                @endphp
                <img id="main-product-image" src="{{ $mainImage }}" alt="{{ $product->title }}" class="w-full h-auto object-cover transform transition hover:scale-105 duration-500 cursor-zoom-in">
                <span class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg" id="discount-badge" style="display: none;">-0%</span>
            </div>
            
            <!-- Mobile Thumbnails -->
            <div class="flex md:hidden gap-4 overflow-x-auto pb-4">
                 @foreach($product->media as $media)
                <button class="border border-gray-200 hover:border-blue-500 rounded overflow-hidden w-20 h-20 flex-shrink-0 thumbnail-btn" onclick="changeImage('{{ $media->getUrl() }}')">
                    <img src="{{ $media->getUrl() }}" class="w-full h-full object-cover">
                </button>
                @endforeach
            </div>
        </div>

        <!-- Product Info -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->title }}</h1>
            
            <div class="flex items-center mb-4">
                <div class="flex text-yellow-400 text-sm mr-2">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <span class="text-gray-500 text-sm">(12 Reviews)</span>
                <span class="mx-2 text-gray-300">|</span>
                <span class="text-green-600 text-sm font-medium"><i class="fa fa-check-circle mr-1"></i> In Stock</span>
            </div>

            <div class="mb-6">
                <p class="text-gray-500 text-sm mb-1">SKU: <span id="product-sku" class="text-gray-900 font-medium">N/A</span></p>
                <div class="flex items-baseline gap-4">
                    <span id="product-price" class="text-4xl font-bold text-blue-600">$0.00</span>
                    <span id="product-old-price" class="text-xl text-gray-400 line-through" style="display: none;">$0.00</span>
                </div>
            </div>

            <div class="prose prose-sm text-gray-600 mb-8 max-w-none">
                {!! \Illuminate\Support\Str::limit(strip_tags($product->description), 200) !!}
                <a href="#description" class="text-blue-600 hover:underline">Read more</a>
            </div>

            <!-- Attribute Selectors -->
            @php
                // Group product attributes by Group Name
                // We need to fetch attribute groups first. Logic:
                // $product->attributes contains all attributes associated with product (union of all variants)
                // We group them by attribute_group_id
                $groupedAttributes = $product->attributes->groupBy('attribute_group_id');
            @endphp
            
            <form action="{{ route('add-to-cart') }}" method="POST" id="add-to-cart-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="variant_id" id="selected-variant-id">

                @if($groupedAttributes->isNotEmpty())
                    @foreach($groupedAttributes as $groupId => $attributes)
                        @php
                            $groupName = \App\Models\AttributeGroup::find($groupId)->title ?? 'Attribute';
                        @endphp
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">{{ $groupName }}</label>
                            <div class="flex flex-wrap gap-3">
                                @foreach($attributes->unique('id') as $attr)
                                <label class="cursor-pointer">
                                    <input type="radio" name="attribute[{{ $groupId }}]" value="{{ $attr->id }}" class="sr-only attribute-selector" data-group="{{ $groupId }}" required>
                                    <span class="px-4 py-2 border border-gray-300 rounded text-sm hover:border-blue-500 hover:text-blue-600 transition-colors peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600 selector-label">
                                        {{ $attr->title }}
                                    </span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="flex items-center gap-4 mb-8">
                    <!-- Quantity -->
                    <div class="flex items-center border border-gray-300 rounded">
                        <button type="button" class="px-3 py-2 text-gray-600 hover:bg-gray-100" onclick="decrementQty()">-</button>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" class="w-12 text-center text-gray-900 focus:outline-none border-0 py-2 h-full" readonly>
                        <button type="button" class="px-3 py-2 text-gray-600 hover:bg-gray-100" onclick="incrementQty()">+</button>
                    </div>

                    <!-- Add to Cart -->
                    <button type="submit" id="add-to-cart-btn" class="flex-1 bg-blue-600 text-white font-bold py-3 px-8 rounded shadow-lg hover:bg-blue-700 transition transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fa fa-shopping-cart mr-2"></i> Add to Cart
                    </button>
                    
                     <button type="button" class="bg-gray-100 text-gray-600 p-3 rounded hover:bg-red-50 hover:text-red-500 transition border border-gray-200" title="Add to Wishlist">
                        <i class="fa fa-heart"></i>
                    </button>
                </div>
            </form>

            <!-- Social Share -->
            <div class="flex items-center space-x-4 mt-8 border-t pt-6">
                <span class="text-sm font-bold text-gray-700">Share:</span>
                <a href="#" class="text-gray-400 hover:text-blue-600"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-gray-400 hover:text-blue-400"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-gray-400 hover:text-red-600"><i class="fab fa-pinterest"></i></a>
            </div>
        </div>
    </div>

    <!-- Product Details Tabs -->
    <div class="mt-16 bg-white rounded-lg shadow-sm border border-gray-100" id="description">
        <div class="border-b px-4">
            <nav class="flex -mb-px space-x-8" aria-label="Tabs">
                <button class="border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Description</button>
                <button class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Additional Information</button>
                <button class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Reviews (0)</button>
            </nav>
        </div>
        <div class="p-8 prose max-w-none text-gray-600">
            {!! $product->description !!}
        </div>
    </div>
    
    <!-- Related Products -->
    @if(isset($relatedProducts) && $relatedProducts->isNotEmpty())
    <div class="mt-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($relatedProducts as $related)
             <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition border border-gray-100 group">
                <div class="relative aspect-w-1 aspect-h-1 bg-gray-100 overflow-hidden rounded-t-lg">
                    @php
                        $relImage = $related->avatar_url;
                    @endphp
                    <img src="{{ $relImage }}" class="w-full h-48 object-cover object-center group-hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-900 text-sm mb-1 truncate"><a href="{{ route('products.single', $related->slug) }}">{{ $related->title }}</a></h3>
                    <p class="text-blue-600 font-bold">${{ number_format($related->variants->min('price'), 2) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
    // Pass Variants Data to JS
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

    // Handle Image Change
    window.changeImage = function(url) {
        document.getElementById('main-product-image').src = url;
    }

    // Handle Quantity
    window.incrementQty = function() {
        let el = document.getElementById('quantity');
        el.value = parseInt(el.value) + 1;
    }
    window.decrementQty = function() {
        let el = document.getElementById('quantity');
        if(parseInt(el.value) > 1) el.value = parseInt(el.value) - 1;
    }

    // Handle Attribute Selection
    attributeSelectors.forEach(radio => {
        radio.addEventListener('change', function() {
            // Highlight Label
            document.querySelectorAll(`input[name="${this.name}"]`).forEach(inp => {
                inp.nextElementSibling.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
                inp.nextElementSibling.classList.add('border-gray-300');
            });
            this.nextElementSibling.classList.add('bg-blue-600', 'text-white', 'border-blue-600');
            this.nextElementSibling.classList.remove('border-gray-300');

            checkVariantMatch();
        });
    });

    function checkVariantMatch() {
        // Collect selected attribute IDs
        const selected = {};
        let allSelected = true;

        // Get all unique group IDs present in the form
        const groups = [...new Set([...attributeSelectors].map(el => el.dataset.group))];

        groups.forEach(groupId => {
            const checked = document.querySelector(`input[name="attribute[${groupId}]"]:checked`);
            if (checked) {
                selected[groupId] = parseInt(checked.value);
            } else {
                allSelected = false;
            }
        });

        if (!allSelected) {
            // Not all attributes selected yet
            addToCartBtn.disabled = true;
            addToCartBtn.innerHTML = '<i class="fa fa-shopping-cart mr-2"></i> Select Options';
            return;
        }

        // Find matching variant
        const matchedVariant = variants.find(variant => {
            // Check if every attribute in the variant matches the selected ones
            // Logic: Variant attributes must match selected attributes.
            // Variant might have MORE attributes if we defined extra groups not shown? Unlikely.
            // We check: For every group selected, does the variant have that attribute?
            
            // Actually, we check if variable has ALL selected attributes
            // A variant is defined by a specific combination.
            
            // Simple check: Variant must contain all selected {group_id: attr_id} pairs
            return Object.keys(selected).every(groupId => {
                return variant.attributes.some(attr => attr.group_id == groupId && attr.attribute_id == selected[groupId]);
            });
        });

        if (matchedVariant) {
            // Update UI
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
            addToCartBtn.innerHTML = '<i class="fa fa-shopping-cart mr-2"></i> Add to Cart';
        } else {
            // Combination unavailable
            addToCartBtn.disabled = true;
            addToCartBtn.innerHTML = 'Unavailable';
            priceEl.innerText = 'Unavailable';
        }
    }

    // Initialize: Check if only 1 option per group, auto select? 
    // Or just initial state.
    checkVariantMatch();
</script>
@endpush
