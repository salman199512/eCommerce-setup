@extends('frontend.layouts.master')

@section('meta_title', 'The Archive | Shop All')

@section('content')

<!-- Minimalist Shop Header -->
<div class="bg-white pt-24 pb-12">
    <div class="container mx-auto px-4 text-center">
        <span class="text-red-600 text-xs font-bold uppercase tracking-cinematic mb-4 block">The Collection</span>
        <h1 class="text-4xl md:text-5xl font-bold mb-8">Shop All Products</h1>
        <div class="flex justify-center items-center gap-3 text-xs font-bold uppercase tracking-premium text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-black transition">Home</a>
            <span class="opacity-30">/</span>
            <span class="text-black">Shop</span>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 pb-24 flex flex-col lg:flex-row">
    <!-- Sidebar -->
    <aside class="w-full lg:w-1/4 lg:pr-12 mb-12 lg:mb-0">
        <div class="mb-12">
            <h3 class="font-bold text-black mb-6 uppercase tracking-premium text-xs">Categories</h3>
            <ul class="space-y-4">
                @foreach($sharedCategories as $cat)
                <li class="group">
                    <a href="{{ route('products', ['category' => $cat->slug]) }}" 
                       class="text-[12px] uppercase tracking-premium flex justify-between items-center transition-all duration-300 {{ request('category') == $cat->slug ? 'text-red-600 font-bold' : 'text-gray-500 font-medium hover:text-black' }}">
                        {{ $cat->title }}
                        <span class="text-[9px] bg-gray-50 group-hover:bg-gray-100 rounded-full px-2 py-0.5 transition-colors">{{ $cat->products_count ?? 0 }}</span>
                    </a>
                    @if($cat->subCategories->isNotEmpty() && request('category') == $cat->slug)
                        <ul class="pl-4 mt-4 space-y-3 border-l border-gray-100">
                            @foreach($cat->subCategories as $sub)
                                <li>
                                    <a href="{{ route('products', ['category' => $cat->slug, 'subcategory' => $sub->id]) }}" 
                                       class="text-[9px] uppercase tracking-widest transition-all duration-300 {{ request('subcategory') == $sub->id ? 'text-black font-black' : 'text-gray-400 font-bold hover:text-black' }}">
                                        {{ $sub->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
        
        <!-- Filter Card -->
        <div class="p-8 bg-gray-50 rounded-3xl border border-gray-100">
            <h3 class="font-bold text-black mb-6 uppercase tracking-premium text-xs">Filter Price</h3>
            <div class="space-y-6">
                <div class="flex items-center gap-3">
                    <div class="relative flex-1">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs text-gray-400 font-bold">$</span>
                        <input type="number" placeholder="Min" class="w-full bg-white border border-gray-200 rounded-xl px-8 py-3 text-xs font-bold focus:outline-none focus:border-black transition">
                    </div>
                    <span class="text-gray-300 font-bold">—</span>
                    <div class="relative flex-1">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs text-gray-400 font-bold">$</span>
                        <input type="number" placeholder="Max" class="w-full bg-white border border-gray-200 rounded-xl px-8 py-3 text-xs font-bold focus:outline-none focus:border-black transition">
                    </div>
                </div>
                <button class="w-full bg-black text-white py-4 rounded-xl text-xs font-bold uppercase tracking-premium hover:bg-red-600 transition duration-500 shadow-lg shadow-black/5">
                    Apply Filter
                </button>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="w-full lg:w-3/4">
        <!-- Toolbar -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-10 gap-4">
            <p class="text-[12px] font-bold uppercase tracking-premium text-gray-400">
                Found <span class="text-black">{{ $products->total() }}</span> Pieces
            </p>
            <div class="flex items-center gap-6">
                <div class="relative group">
                    <select class="appearance-none bg-white border-b-2 border-gray-100 py-2 pr-8 text-[12px] font-bold uppercase tracking-premium focus:outline-none focus:border-black transition cursor-pointer">
                        <option>Default Sorting</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Newest First</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-0 top-1/2 -translate-y-1/2 text-xs pointer-events-none text-gray-400 group-hover:text-black transition"></i>
                </div>
                <div class="flex gap-2">
                    <button class="w-10 h-10 flex items-center justify-center bg-black text-white rounded-xl shadow-lg transition duration-500 shadow-black/5">
                        <i class="fa fa-th text-xs"></i>
                    </button>
                    <button class="w-10 h-10 flex items-center justify-center bg-white text-gray-300 hover:text-black rounded-xl border border-gray-100 transition duration-500">
                        <i class="fa fa-list text-xs"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-12">
            @forelse($products as $product)
                @include('frontend.components.product-card', ['product' => $product])
            @empty
                <!-- Static Fallback Items -->
                @for($i = 1; $i <= 10; $i++)
                    @include('frontend.components.product-card', ['product' => null, 'static_index' => $i + 50])
                @endfor
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-20 flex justify-center">
            {{ $products->appends(request()->query())->links('vendor.pagination.simple-premium') }}
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Premium Pagination Overrides */
    .pagination { 
        display: flex; 
        gap: 0.5rem;
    }
    .page-link { 
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        transition: all 0.5s ease;
        border: 2px solid #f3f4f6;
        color: #9ca3af;
    }
    .page-item.active .page-link { 
        background: #000;
        color: #fff;
        border-color: #000;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .page-item:not(.active) .page-link:hover {
        border-color: #000;
        color: #000;
    }
</style>
@endpush
