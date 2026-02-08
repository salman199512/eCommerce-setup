<div class="bg-white group relative product-card h-full flex flex-col">
    <!-- Image Wrapper with Hover -->
    <div class="relative overflow-hidden aspect-w-3 aspect-h-4 bg-gray-100">
        @php
            $imageUrl = $product->avatar_url;
            // Secondary image for hover effect (if available)
            $secondImage = $product->media->count() > 1 ? $product->media[1]->getUrl() : $imageUrl;
        @endphp
        
        <a href="{{ route('products.single', $product->slug) }}" class="block w-full h-full">
            <img src="{{ $imageUrl }}" alt="{{ $product->title }}" class="object-cover w-full h-full transition-opacity duration-500 ease-in-out group-hover:opacity-0 absolute inset-0 z-10">
            <img src="{{ $secondImage }}" alt="{{ $product->title }}" class="object-cover w-full h-full absolute inset-0 z-0 scale-100 group-hover:scale-110 transition-transform duration-700">
        </a>

        <!-- Badges -->
        <div class="absolute top-3 left-3 z-20 flex flex-col space-y-2">
            @if($product->is_new_arrival)
                <span class="bg-black text-white text-[10px] font-bold uppercase px-2 py-1 tracking-wider">New</span>
            @endif
            @if($product->discount > 0 || ($product->variants->count() > 0 && $product->variants->min('discount') > 0))
                <span class="bg-red-600 text-white text-[10px] font-bold uppercase px-2 py-1 tracking-wider">Sale</span>
            @endif
        </div>

        <!-- Quick Actions (Slide Up) -->
        <div class="absolute bottom-4 left-0 right-0 z-20 flex justify-center space-x-2 opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300">
            <button class="bg-white text-gray-800 hover:bg-black hover:text-white p-3 rounded-full shadow-lg transition" title="Add to Wishlist">
                <i class="far fa-heart"></i>
            </button>
            <a href="{{ route('products.single', $product->slug) }}" class="bg-white text-gray-800 hover:bg-black hover:text-white p-3 rounded-full shadow-lg transition" title="Quick View">
                <i class="far fa-eye"></i>
            </a>
            <button class="bg-white text-gray-800 hover:bg-black hover:text-white p-3 rounded-full shadow-lg transition" title="Compare">
                <i class="fas fa-exchange-alt"></i>
            </button>
        </div>
    </div>

    <!-- Product Details -->
    <div class="pt-4 pb-2 text-center flex-1 flex flex-col justify-between">
        <div>
            <span class="text-xs text-gray-400 uppercase tracking-widest mb-1 block">{{ $product->category->title ?? 'FASHION' }}</span>
            <h3 class="text-sm font-medium text-gray-900 mb-2 truncate hover:text-red-600 transition font-serif tracking-wide"><a href="{{ route('products.single', $product->slug) }}">{{ $product->title }}</a></h3>
            
            <!-- Price -->
            <div class="flex justify-center items-center space-x-2 font-bold mb-3">
                @if($product->variants->isNotEmpty())
                    @php
                        $minPrice = $product->variants->min('final_price') ?: $product->variants->min('price');
                        $maxPrice = $product->variants->max('price');
                    @endphp
                     <span class="text-gray-900">${{ number_format($minPrice, 2) }}</span>
                @else
                    <span class="text-gray-900">Out of Stock</span>
                @endif
            </div>
        </div>

        <!-- Add to Cart (Hidden by default, or simple button) -->
        <a href="{{ route('products.single', $product->slug) }}" class="w-full block border border-gray-200 py-2 text-xs font-bold uppercase tracking-widest hover:bg-black hover:text-white hover:border-black transition">Select Options</a>
    </div>
</div>
