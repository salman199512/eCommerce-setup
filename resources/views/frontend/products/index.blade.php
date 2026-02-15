@extends('frontend.layouts.master')

@section('meta_title', 'The Archive | Shop All')

@section('content')

<!-- Minimalist Shop Header -->
<div class="bg-white pt-24 pb-12">
    <div class="container mx-auto px-4 text-center">
        <span class="text-red-600 text-xs font-black uppercase tracking-widest mb-4 block">The Collection</span>
        <h1 class="text-4xl md:text-5xl font-black mb-8 tracking-tighter">Shop All Products</h1>
        <div class="flex justify-center items-center gap-3 text-[10px] font-black uppercase tracking-widest text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-black transition">Home</a>
            <span class="opacity-30">/</span>
            <span class="text-black italic">Curated Shop</span>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 pb-24">
    <div class="flex flex-col lg:flex-row gap-12">
        <!-- Sidebar Filters (Point 4) -->
        <aside class="w-full lg:w-1/4">
            <form action="{{ route('products') }}" method="GET" id="filter-form">
                <input type="hidden" name="sort" id="sort-input" value="{{ request('sort', 'latest') }}">
                
                <div class="space-y-12">
                    <!-- Categories & Subcategories -->
                    <div>
                        <h3 class="font-black text-black mb-6 uppercase tracking-widest text-[11px] border-b border-gray-100 pb-3">Categories</h3>
                        <div class="space-y-4">
                            @foreach($categories as $cat)
                            <div x-data="{ open: {{ request('category') == $cat->slug ? 'true' : 'false' }} }">
                                <div class="flex justify-between items-center group cursor-pointer" @click="open = !open">
                                    <a href="{{ route('products', ['category' => $cat->slug]) }}" 
                                       class="text-[11px] font-bold uppercase tracking-widest transition {{ request('category') == $cat->slug ? 'text-red-600' : 'text-gray-500 hover:text-black' }}">
                                        {{ $cat->title }}
                                    </a>
                                    @if($cat->subCategories->isNotEmpty())
                                        <i class="fa fa-angle-down text-[10px] transition-transform duration-300" :class="{'rotate-180': open}"></i>
                                    @endif
                                </div>
                                @if($cat->subCategories->isNotEmpty())
                                    <ul x-show="open" x-transition class="pl-4 mt-4 space-y-3 border-l-2 border-gray-50">
                                        @foreach($cat->subCategories as $sub)
                                            <li>
                                                <a href="{{ route('products', ['category' => $cat->slug, 'sub_category' => $sub->slug]) }}" 
                                                   class="text-[10px] font-bold uppercase tracking-widest transition {{ request('sub_category') == $sub->slug ? 'text-black' : 'text-gray-400 hover:text-black' }}">
                                                    {{ $sub->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Attribute Filters (Point 4) -->
                    @foreach($attributeGroups as $group)
                    <div>
                        <h3 class="font-black text-black mb-6 uppercase tracking-widest text-[11px] border-b border-gray-100 pb-3">{{ $group->title }}</h3>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach($group->attributes as $attr)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <div class="relative w-5 h-5 border-2 border-gray-300 bg-white rounded flex items-center justify-center transition group-hover:border-black shadow-sm">
                                    <input type="checkbox" name="attributes[]" value="{{ $attr->id }}" 
                                           {{ is_array(request('attributes')) && in_array($attr->id, request('attributes')) ? 'checked' : '' }}
                                           onchange="this.form.submit()"
                                           class="absolute inset-0 opacity-0 cursor-pointer z-10">
                                    <div class="w-2.5 h-2.5 bg-black rounded-sm scale-0 transition-transform duration-200 {{ is_array(request('attributes')) && in_array($attr->id, request('attributes')) ? 'scale-100' : '' }}"></div>
                                </div>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-500 group-hover:text-black transition">{{ $attr->title }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                    <!-- Price Filter (Point 4) -->
                    <div>
                        <h3 class="font-black text-black mb-6 uppercase tracking-widest text-[11px] border-b border-gray-100 pb-3">Price Range</h3>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="relative flex-1">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[10px] text-gray-400 font-black">$</span>
                                    <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" 
                                           class="w-full bg-gray-50 border-none rounded-xl px-8 py-3 text-[10px] font-black focus:ring-2 focus:ring-black/5 transition">
                                </div>
                                <span class="text-gray-200 font-bold">—</span>
                                <div class="relative flex-1">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[10px] text-gray-400 font-black">$</span>
                                    <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" 
                                           class="w-full bg-gray-50 border-none rounded-xl px-8 py-3 text-[10px] font-black focus:ring-2 focus:ring-black/5 transition">
                                </div>
                            </div>
                            <button type="submit" class="w-full bg-black text-white py-4 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-red-600 transition duration-500 shadow-xl shadow-black/5">
                                Filter Collection
                            </button>
                        </div>
                    </div>
                    
                    @if(request()->anyFilled(['category', 'sub_category', 'attributes', 'min_price', 'max_price', 'search']))
                        <a href="{{ route('products') }}" class="block w-full border border-gray-100 text-center py-4 rounded-xl text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-red-600 hover:border-red-600 transition">
                            Clear All Filters
                        </a>
                    @endif
                </div>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="w-full lg:w-3/4">
            <!-- Toolbar -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-12 gap-6 pb-6 border-b border-gray-50">
                <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">
                    Showing <span class="text-black">{{ $products->count() }}</span> of <span class="text-black">{{ $products->total() }}</span> Artifacts
                </p>
                <div class="flex items-center gap-8">
                    <div class="relative group">
                        <select onchange="updateSort(this.value)" class="appearance-none bg-transparent border-none py-2 pr-8 text-[10px] font-black uppercase tracking-widest focus:ring-0 cursor-pointer">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest Arrivals</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                        <i class="fas fa-chevron-down absolute right-0 top-1/2 -translate-y-1/2 text-[8px] pointer-events-none text-gray-300 group-hover:text-black transition"></i>
                    </div>
                    <div class="flex gap-3 bg-gray-50 p-1.5 rounded-xl">
                        <button onclick="setView('grid')" id="grid-btn" class="w-8 h-8 flex items-center justify-center rounded-lg transition duration-300 {{ !request('view') || request('view') == 'grid' ? 'bg-white shadow-sm text-black' : 'text-gray-400' }}">
                            <i class="fa fa-th-large text-[10px]"></i>
                        </button>
                        <button onclick="setView('list')" id="list-btn" class="w-8 h-8 flex items-center justify-center rounded-lg transition duration-300 {{ request('view') == 'list' ? 'bg-white shadow-sm text-black' : 'text-gray-400' }}">
                            <i class="fa fa-list text-[10px]"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product Display (Point 5) -->
            <div id="product-container" class="{{ request('view') == 'list' ? 'space-y-8' : 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12' }}">
                @forelse($products as $product)
                    @if(request('view') == 'list')
                        <div class="flex flex-col md:flex-row gap-8 bg-white p-6 rounded-3xl border border-gray-50 group hover:shadow-2xl hover:shadow-black/5 transition duration-500">
                            <div class="w-full md:w-64 bg-gray-50 rounded-2xl overflow-hidden shrink-0" style="aspect-ratio: 3/4;">
                                <img src="{{ $product->avatar_url ?: 'https://via.placeholder.com/800x1067?text=No+Image' }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            </div>
                            <div class="flex-1 py-4 flex flex-col justify-between">
                                <div>
                                    <span class="text-[9px] font-black uppercase tracking-widest text-red-600 mb-3 block">{{ $product->category->title ?? 'Exclusive' }}</span>
                                    <h3 class="text-xl font-black text-black mb-4 tracking-tighter uppercase">{{ $product->title }}</h3>
                                    <p class="text-xs text-gray-400 leading-relaxed line-clamp-3 mb-6">{{ strip_tags($product->description) }}</p>
                                </div>
                                <div class="flex items-center justify-between mt-auto">
                                    <div class="flex flex-col">
                                        @php $fv = $product->variants->first(); $dp = $fv->final_price ?? $fv->price; @endphp
                                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-300 mb-1">Starting Price</span>
                                        <span class="text-2xl font-black tracking-tighter text-black">${{ number_format($dp, 2) }}</span>
                                    </div>
                                    <div class="flex gap-3">
                                        <button onclick="addToWishlist({{ $product->id }})" class="w-12 h-12 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:bg-black hover:text-white transition duration-300">
                                            <i class="far fa-heart"></i>
                                        </button>
                                        <a href="{{ route('products.single', $product->slug) }}" class="px-8 flex items-center justify-center rounded-full bg-black text-white text-[10px] font-black uppercase tracking-widest hover:bg-red-600 transition duration-300">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @include('frontend.components.product-card', ['product' => $product])
                    @endif
                @empty
                    <div class="col-span-full py-24 text-center">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fa fa-box-open text-2xl text-gray-200"></i>
                        </div>
                        <h3 class="text-lg font-black uppercase tracking-tighter text-black mb-2">No artifacts found</h3>
                        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Try adjusting your filters or search query</p>
                        <a href="{{ route('products') }}" class="inline-block mt-8 text-[10px] font-black uppercase tracking-widest text-red-600 border-b border-red-600 pb-1">Reset All</a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-24">
                {{ $products->links('vendor.pagination.simple-premium') }}
            </div>
        </main>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function updateSort(val) {
        $('#sort-input').val(val);
        $('#filter-form').submit();
    }

    function setView(view) {
        const url = new URL(window.location.href);
        url.searchParams.set('view', view);
        window.location.href = url.href;
    }

    function addToWishlist(id) {
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
                    $('.wishlist-btn-' + id).find('i').removeClass('far').addClass('fas text-white');
                    $('.wishlist-btn-' + id).addClass('bg-red-600');
                } else {
                    toastr.warning(response.message);
                }
            }
        });
    }

    function addToCart(variantId, qty) {
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
    }
</script>
@endpush
