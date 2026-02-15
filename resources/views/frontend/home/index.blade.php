@extends('frontend.layouts.master')

@section('meta_title', 'Fashion | Modern Elegance & Style')

@section('content')

<!-- Hero Section Slider -->
<section class="relative h-[80vh] min-h-[500px] overflow-hidden bg-gray-50 flex items-center">
    @if($sliders && $sliders->count() > 0)
        <!-- Dynamic Slider -->
        <div x-data="{ activeSlide: 0, slides: {{ $sliders->count() }} }"
             x-init="setInterval(() => activeSlide = (activeSlide + 1) % slides, 6000)"
             class="absolute inset-0 w-full h-full">
            @foreach($sliders as $index => $slider)
            <div x-show="activeSlide === {{ $index }}"
                 x-transition:enter="transition ease-out duration-1000"
                 x-transition:enter-start="opacity-0 scale-105"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-1000"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute inset-0 w-full h-full">

                @php $bgImage = $slider->getFirstMediaUrl('slider_images') ?: $slider->image_path ?: 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=90'; @endphp
                <img src="{{ $bgImage }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/20"></div>

                <div class="absolute inset-0 container mx-auto px-4 flex items-center">
                    <div class="max-w-2xl text-white">
                        <span class="block text-xs font-bold uppercase tracking-cinematic mb-4">{{ $slider->subtitle ?? 'Collection 2024' }}</span>
                        <h1 class="text-5xl md:text-7xl font-bold mb-8 leading-tight tracking-tighter">{{ $slider->title ?? 'Elegance Redefined' }}</h1>
                        <div>
                            <a href="{{ $slider->link ?? route('products') }}" class="inline-flex items-center gap-4 bg-white text-black px-10 py-5 text-[10px] font-black uppercase tracking-widest hover:bg-black hover:text-white transition-all duration-500 rounded-full">
                                {{ $slider->button_text ?? 'Shop Now' }}
                                <i class="fa fa-arrow-right text-[8px]"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Custom Dots -->
            @if($sliders->count() > 1)
            <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex items-center gap-4 z-20">
                @foreach($sliders as $index => $slider)
                <button @click="activeSlide = {{ $index }}"
                        class="h-1.5 transition-all duration-500 rounded-full"
                        :class="activeSlide === {{ $index }} ? 'w-12 bg-white' : 'w-4 bg-white/30 hover:bg-white/60'"></button>
                @endforeach
            </div>
            @endif
        </div>
    @else
        <!-- Fallback Hero -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=90" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/30"></div>
        </div>
        <div class="relative container mx-auto px-4 text-white">
            <div class="max-w-2xl">
                <span class="block text-xs font-bold uppercase tracking-cinematic mb-4">Collection 2024</span>
                <h1 class="text-6xl md:text-8xl font-bold mb-8 leading-tight tracking-tighter">The Modern<br>Identity</h1>
                <div>
                <a href="{{ route('products') }}" class="inline-flex items-center gap-4 bg-white text-black px-10 py-5 text-[10px] font-black uppercase tracking-widest hover:bg-black hover:text-white transition-all duration-500 rounded-full">
                    Discover Now <i class="fa fa-arrow-right text-[8px]"></i>
                </a>
            </div>
        </div>
    @endif
</section>

<!-- Service Features Section -->
<section class="py-10 bg-gray-50 border-y border-gray-100">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
            <!-- Worldwide Shipping -->
            <div class="flex items-center gap-6 group">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-gray-100 group-hover:border-black transition-all duration-500">
                    <i class="fas fa-shipping-fast text-2xl text-black"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-premium mb-1">Worldwide Shipping</h4>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-premium">Free shipping on all orders</p>
                </div>
            </div>
            <!-- Money Back -->
            <div class="flex items-center gap-6 group">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-gray-100 group-hover:border-black transition-all duration-500">
                    <i class="fas fa-piggy-bank text-2xl text-black"></i>
                </div>
                <div>
                    <h4 class="text-xs font-black uppercase tracking-widest mb-1">Money Back Guarantee</h4>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Back guarantee in 7 days</p>
                </div>
            </div>
            <!-- Discounts -->
            <div class="flex items-center gap-6 group">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-gray-100 group-hover:border-black transition-all duration-500">
                    <i class="fas fa-percentage text-2xl text-black"></i>
                </div>
                <div>
                    <h4 class="text-xs font-black uppercase tracking-widest mb-1">Offers And Discounts</h4>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">On every order over $130.00</p>
                </div>
            </div>
            <!-- Support -->
            <div class="flex items-center gap-6 group">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-gray-100 group-hover:border-black transition-all duration-500">
                    <i class="fas fa-headset text-2xl text-black"></i>
                </div>
                <div>
                    <h4 class="text-xs font-black uppercase tracking-widest mb-1">24/7 Support Services</h4>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Contact us Anytime</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Circular Category Slider -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between mb-12">
            <div>
                <span class="text-red-600 text-xs font-bold uppercase tracking-cinematic mb-2 block">Categories</span>
                <h2 class="text-3xl font-bold tracking-tighter uppercase">Shop by Genre</h2>
            </div>
            <div class="flex gap-2">
                <button class="cat-prev w-10 h-10 border border-gray-100 rounded-full flex items-center justify-center hover:bg-black hover:text-white transition-all">
                    <i class="fas fa-chevron-left text-xs"></i>
                </button>
                <button class="cat-next w-10 h-10 border border-gray-100 rounded-full flex items-center justify-center hover:bg-black hover:text-white transition-all">
                    <i class="fas fa-chevron-right text-xs"></i>
                </button>
            </div>
        </div>

        <div class="swiper circular-cat-swiper">
            <div class="swiper-wrapper">
                @foreach($categories as $category)
                <div class="swiper-slide text-center group">
                    <a href="{{ route('products', ['category' => $category->slug]) }}" class="block">
                        <div class="w-32 h-32 md:w-44 md:h-44 mx-auto rounded-full overflow-hidden border-4 border-gray-50 group-hover:border-black transition-all duration-500 relative mb-6">
                            <img src="{{ $category->image_url ?? 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?auto=format&fit=crop&w=400&q=80' }}"
                                 class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>
                        </div>
                        <h4 class="text-sm font-bold uppercase tracking-premium group-hover:text-red-600 transition-colors">{{ $category->title }}</h4>
                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-premium mt-1.5 block">Explore Items</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Latest Products (2-Row Slider) -->
<section class="py-24 bg-gray-50 overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="flex items-end justify-between mb-16">
            <div>
                <span class="text-red-600 text-xs font-bold uppercase tracking-cinematic mb-4 block">Newest Arrivals</span>
                <h2 class="text-4xl font-bold tracking-tighter uppercase">Latest Products</h2>
            </div>
            <div class="flex gap-2 mb-2">
                <button class="latest-prev w-12 h-12 border border-gray-200 rounded-full flex items-center justify-center hover:bg-black hover:text-white transition-all">
                    <i class="fas fa-chevron-left text-sm"></i>
                </button>
                <button class="latest-next w-12 h-12 border border-gray-200 rounded-full flex items-center justify-center hover:bg-black hover:text-white transition-all">
                    <i class="fas fa-chevron-right text-sm"></i>
                </button>
            </div>
        </div>

        <div class="swiper latest-product-swiper">
            <div class="swiper-wrapper">
                @forelse($newArrivals as $product)
                <div class="swiper-slide h-auto">
                    @include('frontend.components.product-card', ['product' => $product])
                </div>
                @empty
                    @for($i = 1; $i <= 10; $i++)
                    <div class="swiper-slide h-auto">
                        @include('frontend.components.product-card', ['product' => null, 'static_index' => $i])
                    </div>
                    @endfor
                @endforelse
            </div>
            <div class="swiper-pagination !static mt-10"></div>
        </div>
    </div>
</section>

<!-- Featured Products (2-Row Slider) -->
<section class="py-24 bg-white overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="flex items-end justify-between mb-16">
            <div>
                <span class="text-red-600 text-xs font-bold uppercase tracking-cinematic mb-4 block">Handpicked</span>
                <h2 class="text-4xl font-bold tracking-tighter uppercase">Featured Collection</h2>
            </div>
            <div class="flex gap-2 mb-2">
                <button class="featured-prev w-12 h-12 border border-gray-200 rounded-full flex items-center justify-center hover:bg-black hover:text-white transition-all">
                    <i class="fas fa-chevron-left text-sm"></i>
                </button>
                <button class="featured-next w-12 h-12 border border-gray-200 rounded-full flex items-center justify-center hover:bg-black hover:text-white transition-all">
                    <i class="fas fa-chevron-right text-sm"></i>
                </button>
            </div>
        </div>

        <div class="swiper featured-product-swiper">
            <div class="swiper-wrapper">
                @forelse($featuredProducts as $product)
                <div class="swiper-slide h-auto">
                    @include('frontend.components.product-card', ['product' => $product])
                </div>
                @empty
                    @for($i = 1; $i <= 10; $i++)
                    <div class="swiper-slide h-auto">
                        @include('frontend.components.product-card', ['product' => null, 'static_index' => $i + 10])
                    </div>
                    @endfor
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- Top Selling Products (2-Row Slider) -->
<section class="py-24 bg-gray-50 overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="flex items-end justify-between mb-16">
            <div>
                <span class="text-red-600 text-xs font-bold uppercase tracking-cinematic mb-4 block">Best Sellers</span>
                <h2 class="text-4xl font-bold tracking-tighter uppercase">Top Trending</h2>
            </div>
            <div class="flex gap-2 mb-2">
                <button class="top-prev w-12 h-12 border border-gray-200 rounded-full flex items-center justify-center hover:bg-black hover:text-white transition-all">
                    <i class="fas fa-chevron-left text-sm"></i>
                </button>
                <button class="top-next w-12 h-12 border border-gray-200 rounded-full flex items-center justify-center hover:bg-black hover:text-white transition-all">
                    <i class="fas fa-chevron-right text-sm"></i>
                </button>
            </div>
        </div>

        <div class="swiper top-product-swiper">
            <div class="swiper-wrapper">
                @forelse($bestSellers as $product)
                <div class="swiper-slide h-auto">
                    @include('frontend.components.product-card', ['product' => $product])
                </div>
                @empty
                    @for($i = 1; $i <= 10; $i++)
                    <div class="swiper-slide h-auto">
                        @include('frontend.components.product-card', ['product' => null, 'static_index' => $i + 20])
                    </div>
                    @endfor
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- Reviews Slider -->
<section class="py-32 bg-white relative overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="text-center mb-20">
            <h2 class="text-3xl md:text-5xl font-bold tracking-tighter uppercase mb-4">What Our Clients Say</h2>
            <p class="text-gray-500 text-sm max-w-xl mx-auto font-medium">There are many variations of passages of lorem Ipsum available</p>
        </div>

        <div class="relative md:px-12">
            <div class="swiper review-swiper">
                <div class="swiper-wrapper">
                    @forelse($testimonials as $testimonial)
                    <div class="swiper-slide h-auto">
                        <div class="bg-gray-50 p-10 flex flex-col h-full border border-gray-100/50 rounded-sm">
                            <h4 class="text-[13px] font-bold text-black mb-6 uppercase tracking-premium leading-snug">"{{ \Illuminate\Support\Str::limit($testimonial->content, 80) }}"</h4>
                            <p class="text-[12px] text-gray-500 leading-relaxed mb-10 flex-1 font-medium">
                                {{ $testimonial->content }}
                            </p>
                            <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                                <img src="{{ $testimonial->avatar_url }}" class="w-12 h-12 rounded-full object-cover grayscale">
                                <div>
                                    <h5 class="text-[11px] font-bold text-black uppercase tracking-widest">{{ $testimonial->name }}</h5>
                                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-premium block mt-1">{{ $testimonial->role }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        @for($i = 1; $i <= 3; $i++)
                        <div class="swiper-slide h-auto">
                            <div class="bg-gray-50 p-10 flex flex-col h-full border border-gray-100/50 rounded-sm">
                                <h4 class="text-[13px] font-bold text-black mb-6 uppercase tracking-premium leading-snug">"Impressive quality, durable and reliable."</h4>
                                <p class="text-[12px] text-gray-500 leading-relaxed mb-10 flex-1 font-medium">
                                    Generation many variations of passages of even blievable lorem Ipsum is simply dummy text of the printing and typesetting.
                                </p>
                                <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                                    <img src="https://i.pravatar.cc/100?u={{ $i }}" class="w-12 h-12 rounded-full object-cover grayscale">
                                    <div>
                                        <h5 class="text-[11px] font-bold text-black uppercase tracking-widest">Premium Client</h5>
                                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-premium block mt-1">Verified Buyer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                    @endforelse
                </div>
            </div>

            <!-- Side Navigation -->
            <button class="review-prev absolute -left-4 md:-left-6 top-1/2 -translate-y-1/2 w-12 h-12 bg-white rounded-full flex items-center justify-center text-gray-400 hover:bg-black hover:text-white transition-all z-20 shadow-xl border border-gray-50">
                <i class="fas fa-chevron-left text-xs"></i>
            </button>
            <button class="review-next absolute -right-4 md:-right-6 top-1/2 -translate-y-1/2 w-12 h-12 bg-white rounded-full flex items-center justify-center text-gray-400 hover:bg-black hover:text-white transition-all z-20 shadow-xl border border-gray-50">
                <i class="fas fa-chevron-right text-xs"></i>
            </button>
        </div>
    </div>
</section>


<!-- Newsletter / COMMUNION -->
<section class="py-10 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-16 lg:gap-32">
            <div class="flex-1 text-center lg:text-left">
                <span class="text-red-600 text-xs font-bold uppercase tracking-cinematic mb-4 block">Communion</span>
                <h2 class="text-4xl md:text-5xl font-bold tracking-tighter uppercase mb-6">Join the House</h2>
                <p class="text-gray-500 font-medium leading-relaxed max-w-lg">Receive private invitations to new collections, cinematic stories, and exclusive events.</p>
            </div>
            <div class="flex-1 w-full">
                <form action="{{ route('save.newsletter') }}" method="POST" class="flex flex-col sm:flex-row gap-4">
                    @csrf
                    <input type="email" name="email" placeholder="email@address.com"
                           class="flex-1 bg-gray-50 px-8 py-5 text-sm border-none focus:ring-2 focus:ring-black/5 rounded-full placeholder:text-gray-300 font-medium tracking-wide">
                    <button type="submit" class="bg-black text-white px-10 py-5 text-[10px] font-black uppercase tracking-widest hover:bg-red-600 transition-all duration-500 rounded-full">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Circular Category Swiper
        new Swiper('.circular-cat-swiper', {
            slidesPerView: 2,
            spaceBetween: 20,
            navigation: { nextEl: '.cat-next', prevEl: '.cat-prev' },
            breakpoints: {
                640: { slidesPerView: 3, spaceBetween: 30 },
                1024: { slidesPerView: 5, spaceBetween: 40 }
            }
        });

        // 2-Row Multi-Line Product Sliders
        const productSliderOptions = (prev, next) => ({
            slidesPerView: 1,
            grid: { rows: 2, fill: 'row' },
            spaceBetween: 30,
            navigation: { nextEl: next, prevEl: prev },
            pagination: { clickable: true },
            breakpoints: {
                640: { slidesPerView: 2, grid: { rows: 2 } },
                1024: { slidesPerView: 4, grid: { rows: 2 } }
            }
        });

        new Swiper('.latest-product-swiper', productSliderOptions('.latest-prev', '.latest-next'));
        new Swiper('.featured-product-swiper', productSliderOptions('.featured-prev', '.featured-next'));
        new Swiper('.top-product-swiper', productSliderOptions('.top-prev', '.top-next'));

        // Review Swiper
        new Swiper('.review-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: { delay: 5000 },
            navigation: { nextEl: '.review-next', prevEl: '.review-prev' },
            breakpoints: {
                768: { slidesPerView: 2, spaceBetween: 30 },
                1024: { slidesPerView: 3, spaceBetween: 40 }
            }
        });
    });
</script>
@endpush
