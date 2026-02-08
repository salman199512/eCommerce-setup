@extends('frontend.layouts.master')

@section('meta_title', 'Shop All Products')

@section('content')

<!-- Brief Breadcrumb -->
<div class="bg-gray-100 py-4">
    <div class="container mx-auto px-4">
        <ol class="list-reset flex text-gray-500 text-sm">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600">Home</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-800">Shop</li>
        </ol>
    </div>
</div>

<div class="container mx-auto px-4 py-8 flex flex-col md:flex-row">
    <!-- Sidebar -->
    <aside class="w-full md:w-1/4 pr-8 mb-8 md:mb-0 hidden md:block">
        <div class="mb-8">
            <h3 class="font-bold text-gray-800 mb-4 uppercase tracking-wider text-sm border-b pb-2">Categories</h3>
            <ul class="space-y-2">
                 @foreach($sharedCategories as $cat)
                <li>
                    <a href="{{ route('products', ['category' => $cat->slug]) }}" class="text-gray-600 hover:text-blue-600 flex justify-between items-center {{ request('category') == $cat->slug ? 'font-bold text-blue-600' : '' }}">
                        {{ $cat->title }}
                        <span class="text-xs bg-gray-100 rounded px-2">{{ $cat->products_count ?? '' }}</span>
                    </a>
                     @if($cat->subCategories->isNotEmpty())
                        <ul class="pl-4 mt-1 space-y-1">
                            @foreach($cat->subCategories as $sub)
                                <li><a href="{{ route('products', ['category' => $cat->slug, 'subcategory' => $sub->id]) }}" class="text-sm text-gray-500 hover:text-blue-500">{{ $sub->title }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
        
        <!-- Price Filter (Visual only for now) -->
        <div class="mb-8">
            <h3 class="font-bold text-gray-800 mb-4 uppercase tracking-wider text-sm border-b pb-2">Price</h3>
            <div class="flex items-center space-x-2">
                <input type="number" placeholder="Min" class="w-20 border rounded px-2 py-1 text-sm">
                <span>-</span>
                <input type="number" placeholder="Max" class="w-20 border rounded px-2 py-1 text-sm">
                <button class="bg-gray-200 px-2 py-1 rounded hover:bg-gray-300"><i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="w-full md:w-3/4">
        <!-- Toolbar -->
        <div class="flex justify-between items-center mb-6">
            <p class="text-gray-600 text-sm">Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} results</p>
            <div class="flex items-center space-x-4">
                 <select class="border rounded px-2 py-1 text-sm bg-white focus:outline-none">
                     <option>Default Sorting</option>
                     <option>Price: Low to High</option>
                     <option>Price: High to Low</option>
                     <option>Newest First</option>
                 </select>
                <!-- Grid/List Toggle (Visual) -->
                <div class="flex bg-gray-100 rounded p-1">
                    <button class="p-1 px-2 bg-white shadow rounded"><i class="fa fa-th"></i></button>
                    <button class="p-1 px-2 text-gray-500 hover:text-gray-800"><i class="fa fa-list"></i></button>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($products as $product)
                <div class="bg-white rounded-lg shadow-sm hover:shadow-lg transition duration-300 border border-gray-100 group relative">
                    <div class="relative aspect-w-4 aspect-h-3 bg-gray-100 overflow-hidden">
                         @php
                            $imageUrl = $product->media->first() ? $product->media->first()->getUrl() : 'https://ui-avatars.com/api/?name='.$product->title.'&background=random&size=400';
                         @endphp
                        <img src="{{ $imageUrl }}" alt="{{ $product->title }}" class="w-full h-48 object-cover object-center group-hover:scale-105 transition-transform duration-500">
                        @if($product->discount > 0)
                            <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">-{{ $product->discount }}%</span>
                        @endif
                         <!-- Overlay Actions -->
                         <div class="absolute inset-0 bg-black bg-opacity-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center space-x-2">
                             <a href="{{ route('products.single', $product->slug) }}" class="bg-white p-2 text-gray-700 rounded-full hover:bg-blue-600 hover:text-white transition shadow" title="Quick View"><i class="fa fa-eye"></i></a>
                             <button class="bg-white p-2 text-gray-700 rounded-full hover:bg-red-500 hover:text-white transition shadow" title="Add to Wishlist"><i class="fa fa-heart"></i></button>
                         </div>
                    </div>
                    
                    <div class="p-4">
                        <p class="text-xs text-gray-500 mb-1">{{ $product->category->title ?? '' }}</p>
                        <h3 class="font-bold text-gray-800 text-lg mb-2 truncate"><a href="{{ route('products.single', $product->slug) }}">{{ $product->title }}</a></h3>
                        
                        <div class="flex items-center justify-between mt-auto">
                            <div>
                            @if($product->variants->isNotEmpty())
                                @php
                                    $minPrice = $product->variants->min('price');
                                    // Calculate discount logic if needed, simplify for listing
                                @endphp
                                <span class="text-blue-600 font-bold">${{ number_format($minPrice, 2) }}</span>
                            @else
                                <span class="text-gray-400 text-sm">Out of Stock</span>
                            @endif
                            </div>
                            <div class="text-yellow-400 text-xs">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                    </div>
                     <div class="border-t border-gray-100 p-2">
                        <a href="{{ route('products.single', $product->slug) }}" class="block w-full text-center bg-gray-50 text-gray-600 py-2 rounded text-sm hover:bg-blue-600 hover:text-white transition duration-300 font-medium"><i class="fa fa-shopping-cart mr-1"></i> SELECT OPTIONS</a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded shadow-sm">
                    <p class="text-gray-500 text-lg">No products found matching your criteria.</p>
                    <a href="{{ route('products') }}" class="mt-4 inline-block text-blue-600 hover:underline">Clear Filters</a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Custom pagination if Laravel default is not compatible with Tailwind immediately */
    .pagination { display: flex; justify-content: center; }
    .page-item { margin: 0 2px; }
    .page-link { padding: 0.5rem 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.25rem; color: #4a5568; }
    .page-item.active .page-link { background-color: #3182ce; color: white; border-color: #3182ce; }
</style>
@endpush
