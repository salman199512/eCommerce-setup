<div class="group relative product-card h-full flex flex-col bg-white">
    <!-- Image Wrapper -->
    <div class="relative overflow-hidden aspect-[3/4] bg-gray-50 rounded-2xl">
        @php
            if($product) {
                $imageUrl = $product->avatar_url;
                $secondImage = $product->media->count() > 1 ? $product->media[1]->getUrl() : $imageUrl;
                $title = $product->title;
                $category = $product->category->title ?? 'Exclusive';
                $url = route('products.single', $product->slug);
                $isNew = $product->is_new_arrival;
                $hasDiscount = $product->discount > 0 || ($product->variants->count() > 0 && $product->variants->min('discount') > 0);
            } else {
                $stIdx = $static_index ?? 1;
                $imageUrl = "https://images.unsplash.com/photo-".(1500000000000 + ($stIdx * 1234567))."?auto=format&fit=crop&w=800&q=80";
                $secondImage = "https://images.unsplash.com/photo-".(1500000000000 + ($stIdx * 7654321))."?auto=format&fit=crop&w=800&q=80";
                $title = "Premium " . ($stIdx % 2 == 0 ? "Winter" : "Summer") . " Piece #".$stIdx;
                $category = "Archival Collection";
                $url = "#";
                $isNew = $stIdx % 3 == 0;
                $hasDiscount = $stIdx % 5 == 0;
            }
        @endphp
        
        <a href="{{ $url }}" class="block w-full h-full relative z-10">
            <img src="{{ $imageUrl }}" alt="{{ $title }}" 
                 class="object-cover w-full h-full transition-all duration-700 ease-in-out group-hover:opacity-0 group-hover:scale-105">
            <img src="{{ $secondImage }}" alt="{{ $title }}" 
                 class="object-cover w-full h-full absolute inset-0 z-0 scale-100 group-hover:scale-105 transition-all duration-700 opacity-0 group-hover:opacity-100 border-none">
        </a>

        <!-- Premium Badges -->
        <div class="absolute top-4 left-4 z-20 flex flex-col gap-2">
            @if($isNew)
                <span class="bg-black text-white text-[8px] font-bold uppercase px-3 py-1.5 rounded-full tracking-premium shadow-sm">New</span>
            @endif
            @if($hasDiscount)
                <span class="bg-red-600 text-white text-[8px] font-bold uppercase px-3 py-1.5 rounded-full tracking-premium shadow-sm">Sale</span>
            @endif
        </div>

        <!-- Float Actions -->
        <div class="absolute bottom-6 left-0 right-0 z-20 flex justify-center gap-3 opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500 ease-out">
            <button class="w-10 h-10 bg-white text-black hover:bg-black hover:text-white rounded-full shadow-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110">
                <i class="far fa-heart text-sm"></i>
            </button>
            <a href="{{ $url }}" 
               class="w-10 h-10 bg-white text-black hover:bg-black hover:text-white rounded-full shadow-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110">
                <i class="far fa-eye text-sm"></i>
            </a>
            <button class="w-10 h-10 bg-black text-white hover:bg-red-600 rounded-full shadow-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110">
                <i class="fas fa-shopping-bag text-sm"></i>
            </button>
        </div>
    </div>

    <!-- Details -->
    <div class="pt-5 pb-3 px-1 flex-1 flex flex-col">
        <div class="mb-auto">
            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-premium mb-2 block leading-none">{{ $category }}</span>
            <h3 class="text-sm font-bold text-black mb-2 group-hover:text-red-600 transition-colors duration-300 line-clamp-1 leading-tight tracking-tight uppercase">
                <a href="{{ $url }}">{{ $title }}</a>
            </h3>
            
            <div class="flex items-center gap-2">
                @if($product && $product->variants->isNotEmpty())
                    @php
                        $minPrice = $product->variants->min('final_price') ?: $product->variants->min('price');
                        $originalPrice = $product->variants->max('price');
                    @endphp
                    <span class="text-black font-bold text-base tracking-tight">${{ number_format($minPrice, 2) }}</span>
                    @if($originalPrice > $minPrice)
                        <span class="text-gray-300 text-xs line-through font-medium">${{ number_format($originalPrice, 2) }}</span>
                    @endif
                @elseif(!$product)
                    <span class="text-black font-bold text-base tracking-tight">${{ number_format(rand(100, 500), 2) }}</span>
                @else
                    <span class="text-gray-400 text-[10px] font-bold uppercase tracking-premium">Out of Stock</span>
                @endif
            </div>
        </div>
    </div>
</div>
