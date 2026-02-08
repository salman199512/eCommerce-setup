@extends('frontend.layouts.master')

@section('meta_title', 'Fashion - Premium Prestashop Theme')

@section('content')

<!-- Hero Section Slider -->
<div class="relative bg-gray-100 overflow-hidden h-[600px] flex items-center justify-center">
    @if($sliders && $sliders->count() > 0)
        <!-- Dynamic Slider (Simple Fade) -->
        <div x-data="{ activeSlide: 0, slides: {{ $sliders->count() }} }" class="absolute inset-0 w-full h-full">
            @foreach($sliders as $index => $slider)
            <div x-show="activeSlide === {{ $index }}" 
                 x-transition:enter="transition ease-out duration-1000"
                 x-transition:enter-start="opacity-0 transform scale-105"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-1000"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 class="absolute inset-0 w-full h-full">
                
                @php $bgImage = $slider->getFirstMediaUrl('slider_images') ?: $slider->image_path ?: 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?ixlib=rb-1.2.1&auto=format&fit=crop&w=2073&q=80'; @endphp
                <img src="{{ $bgImage }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black opacity-30"></div>
                
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-center text-white px-4">
                        <span class="block text-sm uppercase tracking-[0.3em] mb-4 animate-fadeInUp">{{ $slider->subtitle ?? 'New Collection' }}</span>
                        <h1 class="text-6xl md:text-8xl font-serif font-bold mb-6 animate-fadeInUp delay-100">{{ $slider->title ?? 'Elevate Your Style' }}</h1>
                        <a href="{{ $slider->link ?? route('products') }}" class="inline-block border-2 border-white px-10 py-4 text-sm font-bold uppercase tracking-widest hover:bg-white hover:text-black transition duration-300 animate-fadeInUp delay-300">{{ $slider->button_text ?? 'Shop Now' }}</a>
                    </div>
                </div>
            </div>
            @endforeach
            
            <!-- Controls (Simple) -->
            @if($sliders->count() > 1)
            <div class="absolute bottom-8 left-0 right-0 flex justify-center space-x-2 z-20">
                @foreach($sliders as $index => $slider)
                <button @click="activeSlide = {{ $index }}" :class="{'bg-white': activeSlide === {{ $index }}, 'bg-gray-500': activeSlide !== {{ $index }}}" class="w-3 h-3 rounded-full transition"></button>
                @endforeach
            </div>
            <!-- Auto play script could be added here -->
            @endif
        </div>
    @else
        <!-- Static Fallback -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1496747611176-843222e1e57c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2073&q=80" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black opacity-20"></div>
        </div>
        <div class="relative z-10 text-center text-white px-4">
            <span class="block text-sm uppercase tracking-[0.3em] mb-4 animate-fadeInUp">New Collection 2024</span>
            <h1 class="text-6xl md:text-8xl font-serif font-bold mb-6 animate-fadeInUp delay-100">Elevate Your Style</h1>
            <p class="text-lg md:text-xl mb-8 font-light max-w-2xl mx-auto animate-fadeInUp delay-200">Discover the latest trends in fashion. Exclusive designs for the modern individual.</p>
            <a href="{{ route('products') }}" class="inline-block border-2 border-white px-10 py-4 text-sm font-bold uppercase tracking-widest hover:bg-white hover:text-black transition duration-300 animate-fadeInUp delay-300">Shop Now</a>
        </div>
    @endif
</div>

<!-- Category Banners (Grid) -->
<section class="py-16">
    <div class="container mx-auto px-4">
        @if($banners && $banners->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($banners as $banner)
                <div class="relative group overflow-hidden h-64 md:h-80">
                     @php $bImage = $banner->getFirstMediaUrl('banner_images') ?: $banner->image_path ?: 'https://via.placeholder.com/800x600'; @endphp
                    <img src="{{ $bImage }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
                    <div class="absolute bottom-8 left-8 text-white">
                        <span class="text-xs uppercase tracking-wider mb-2 block">{{ $banner->subtitle }}</span>
                        <h3 class="text-2xl font-serif font-bold">{{ $banner->title }}</h3>
                        <a href="{{ $banner->link ?? route('products') }}" class="inline-block mt-4 border-b border-white hover:text-red-400 hover:border-red-400 transition">Shop Now</a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- Static Fallback Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Banner 1 -->
                <div class="relative group overflow-hidden h-64 md:h-80">
                    <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
                    <div class="absolute bottom-8 left-8 text-white">
                        <span class="text-xs uppercase tracking-wider mb-2 block">For Her</span>
                        <h3 class="text-2xl font-serif font-bold">Women's Collection</h3>
                        <a href="{{ route('products') }}" class="inline-block mt-4 border-b border-white hover:text-red-400 hover:border-red-400 transition">Shop Now</a>
                    </div>
                </div>
                 <!-- Banner 2 -->
                 <div class="relative group overflow-hidden h-64 md:h-80">
                    <img src="https://images.unsplash.com/photo-1617137968427-85924c800a22?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
                     <div class="absolute bottom-8 left-8 text-white">
                        <span class="text-xs uppercase tracking-wider mb-2 block">For Him</span>
                        <h3 class="text-2xl font-serif font-bold">Men's Essentials</h3>
                        <a href="{{ route('products') }}" class="inline-block mt-4 border-b border-white hover:text-red-400 hover:border-red-400 transition">Shop Now</a>
                    </div>
                </div>
                 <!-- Banner 3 -->
                 <div class="relative group overflow-hidden h-64 md:h-80">
                    <img src="https://images.unsplash.com/photo-1522337660859-02fbefca4702?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
                     <div class="absolute bottom-8 left-8 text-white">
                        <span class="text-xs uppercase tracking-wider mb-2 block">Accessories</span>
                        <h3 class="text-2xl font-serif font-bold">New Accessories</h3>
                        <a href="{{ route('products') }}" class="inline-block mt-4 border-b border-white hover:text-red-400 hover:border-red-400 transition">Shop Now</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Product Tabs (Featured, New, Best) -->
<section class="py-16 bg-white" x-data="{ activeTab: 'featured' }">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-serif font-bold mb-8 uppercase tracking-wide">Trending Items</h2>
        
        <!-- Tabs -->
        <div class="flex justify-center space-x-8 mb-12 border-b border-gray-100 pb-4">
            <button @click="activeTab = 'featured'" :class="{ 'text-black border-red-600': activeTab === 'featured', 'text-gray-400 border-transparent': activeTab !== 'featured' }" class="text-sm font-bold uppercase tracking-widest pb-4 border-b-2 hover:text-black transition focus:outline-none">Featured</button>
            <button @click="activeTab = 'new'" :class="{ 'text-black border-red-600': activeTab === 'new', 'text-gray-400 border-transparent': activeTab !== 'new' }" class="text-sm font-bold uppercase tracking-widest pb-4 border-b-2 hover:text-black transition focus:outline-none">New Arrivals</button>
            <button @click="activeTab = 'best'" :class="{ 'text-black border-red-600': activeTab === 'best', 'text-gray-400 border-transparent': activeTab !== 'best' }" class="text-sm font-bold uppercase tracking-widest pb-4 border-b-2 hover:text-black transition focus:outline-none">Best Sellers</button>
        </div>

        <!-- Featured Grid -->
        <div x-show="activeTab === 'featured'" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
             @each('frontend.components.product-card', $featuredProducts, 'product')
        </div>

        <!-- New Arrivals Grid -->
        <div x-show="activeTab === 'new'" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8" style="display: none;">
             @each('frontend.components.product-card', $newArrivals, 'product')
        </div>

        <!-- Best Sellers Grid -->
        <div x-show="activeTab === 'best'" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8" style="display: none;">
             @each('frontend.components.product-card', $bestSellers, 'product')
        </div>
    </div>
</section>

<!-- Parallax Banner / Deal of Day -->
<section class="relative py-24 bg-fixed bg-center bg-cover" style="background-image: url('https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="container mx-auto px-4 relative z-10 text-center text-white">
        <span class="text-red-500 font-bold uppercase tracking-widest mb-4 block">Limited Time Offer</span>
        <h2 class="text-4xl md:text-6xl font-serif font-bold mb-6">Deal of the Day</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto">Get up to 50% off on selected items. The offer ends soon, so hurry up and grab your favorites.</p>
        
        <!-- Countdown (Static for Demo) -->
        <div class="flex justify-center space-x-4 md:space-x-8 mb-10">
            <div class="text-center">
                <span class="block text-4xl font-bold">02</span>
                <span class="text-xs uppercase">Days</span>
            </div>
            <div class="text-center">
                <span class="block text-4xl font-bold">14</span>
                <span class="text-xs uppercase">Hours</span>
            </div>
            <div class="text-center">
                <span class="block text-4xl font-bold">45</span>
                <span class="text-xs uppercase">Mins</span>
            </div>
             <div class="text-center">
                <span class="block text-4xl font-bold">30</span>
                <span class="text-xs uppercase">Secs</span>
            </div>
        </div>
        
        <a href="{{ route('products') }}" class="bg-red-600 text-white px-10 py-4 font-bold uppercase tracking-widest hover:bg-red-700 transition">Shop Collection</a>
    </div>
</section>

<!-- Latest From Blog (Static) -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-red-500 font-bold uppercase tracking-widest text-xs">Our Journal</span>
            <h2 class="text-3xl font-serif font-bold mt-2">Latest News</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white group">
                <div class="overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1485230946086-1d99d52571eb?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="w-full h-56 object-cover transform group-hover:scale-110 transition duration-500">
                </div>
                <div class="p-6">
                    <span class="text-gray-400 text-xs uppercase mb-2 block">Feb 14, 2024</span>
                    <h3 class="font-serif font-bold text-lg mb-3 hover:text-red-600 cursor-pointer">Top Trends for Summer 2024</h3>
                    <p class="text-gray-600 text-sm mb-4">Discover the hottest styles hitting the runway this season...</p>
                    <a href="#" class="text-red-600 font-bold text-xs uppercase hover:underline">Read More</a>
                </div>
            </div>
            <div class="bg-white group">
                <div class="overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1509319117193-518da7277289?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="w-full h-56 object-cover transform group-hover:scale-110 transition duration-500">
                </div>
                <div class="p-6">
                    <span class="text-gray-400 text-xs uppercase mb-2 block">Jan 28, 2024</span>
                    <h3 class="font-serif font-bold text-lg mb-3 hover:text-red-600 cursor-pointer">The Ultimate Guide to Denim</h3>
                    <p class="text-gray-600 text-sm mb-4">Finding the perfect pair of jeans has never been this easy...</p>
                    <a href="#" class="text-red-600 font-bold text-xs uppercase hover:underline">Read More</a>
                </div>
            </div>
            <div class="bg-white group">
                <div class="overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1487222477894-8943e31ef7b2?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="w-full h-56 object-cover transform group-hover:scale-110 transition duration-500">
                </div>
                <div class="p-6">
                    <span class="text-gray-400 text-xs uppercase mb-2 block">Jan 10, 2024</span>
                    <h3 class="font-serif font-bold text-lg mb-3 hover:text-red-600 cursor-pointer">Accessories That Make a Statement</h3>
                    <p class="text-gray-600 text-sm mb-4">Complete your look with these must-have accessories...</p>
                    <a href="#" class="text-red-600 font-bold text-xs uppercase hover:underline">Read More</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Parallax -->
<section class="py-24 bg-gray-900 text-white text-center">
    <div class="container mx-auto px-4 max-w-2xl">
        <i class="fa fa-envelope-open-text text-4xl mb-6 text-gray-500"></i>
        <h2 class="text-3xl font-serif font-bold mb-4">Subscribe to Our Newsletter</h2>
        <p class="text-gray-400 mb-8">Sign up for our newsletter to receive updates and exclusive offers directly in your inbox.</p>
        <form action="{{ route('save.newsletter') }}" method="POST" class="flex flex-col sm:flex-row gap-4">
            @csrf
            <input type="email" name="email" placeholder="Your Email Address" class="flex-1 px-6 py-4 bg-gray-800 border border-gray-700 focus:outline-none focus:border-red-600 text-white rounded-none">
            <button type="submit" class="bg-red-600 px-8 py-4 font-bold uppercase tracking-widest hover:bg-white hover:text-red-600 transition">Subscribe</button>
        </form>
    </div>
</section>

<!-- Brands Slider (Static Grid) -->
<section class="py-12 border-t border-gray-200">
    <div class="container mx-auto px-4 flex flex-wrap justify-center gap-12 opacity-50 grayscale hover:grayscale-0 transition duration-500">
        <h2 class="sr-only">Our Partners</h2>
        <i class="fab fa-cc-visa text-5xl"></i>
        <i class="fab fa-cc-mastercard text-5xl"></i>
        <i class="fab fa-cc-paypal text-5xl"></i>
        <i class="fab fa-cc-amex text-5xl"></i>
        <i class="fab fa-cc-stripe text-5xl"></i>
    </div>
</section>

@endsection

@push('scripts')
<!-- AlpineJS for Tabs -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endpush
