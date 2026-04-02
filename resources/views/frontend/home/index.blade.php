@extends('frontend.layouts.master')

@section('meta_title', 'FreshMart — Fresh Groceries Delivered to Your Door')

@section('content')

{{-- ── Hero Slider ── --}}
<section class="hero-section">
    @if($sliders && $sliders->count() > 0)
    <div id="hero-slides" style="position:absolute;inset:0;">
        @foreach($sliders as $index => $slider)
        @php $bg = $slider->getFirstMediaUrl('slider_images') ?: $slider->image_path ?: 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=1600&q=90'; @endphp
        <div class="hero-slide" style="{{ $index > 0 ? 'opacity:0;' : 'opacity:1;' }}" data-slide="{{ $index }}">
            <img src="{{ $bg }}" alt="{{ $slider->title }}">
            <div class="hero-overlay"></div>
        </div>
        @endforeach
    </div>
    <div class="hero-dots">
        @foreach($sliders as $i => $s)
        <button class="hero-dot {{ $i == 0 ? 'active' : '' }}" data-dot="{{ $i }}"></button>
        @endforeach
    </div>
    @else
    <div style="position:absolute;inset:0;">
        <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=1600&q=90" alt="FreshMart" style="width:100%;height:100%;object-fit:cover;">
        <div class="hero-overlay"></div>
    </div>
    @endif

    <div class="container" style="position:relative;z-index:10;width:100%;">
        <div class="hero-content animate-fade-up">
            <div class="hero-eyebrow">
                <i class="fas fa-leaf"></i> 100% Premium eCommerce
            </div>
            <h1 class="hero-title">
                The Freshest<br><em>Groceries</em><br>Delivered Fast
            </h1>
            <p class="hero-subtitle">Premium products delivered fast with same-day delivery. Shop premium organic produce, dairy, bakery &amp; more.</p>
            <div class="hero-btns">
                <a href="{{ route('products') }}" class="btn btn-premium-orange btn-xl">
                    <i class="fas fa-cart-shopping"></i> Shop Now
                </a>
                <a href="{{ route('about-us') }}" class="btn btn-ghost btn-xl">
                    <i class="fas fa-play-circle"></i> Our Story
                </a>
            </div>
            <div class="hero-stats">
                <div>
                    <div class="hero-stat-num">50K+</div>
                    <div class="hero-stat-label">Happy Customers</div>
                </div>
                <div>
                    <div class="hero-stat-num">2K+</div>
                    <div class="hero-stat-label">Products</div>
                </div>
                <div>
                    <div class="hero-stat-num">98%</div>
                    <div class="hero-stat-label">Satisfaction</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── Feature Strip ── --}}
<section class="features-strip" style="background:#eff6ff !important;padding:0px 0 !important;border-top:1px solid #e5e7eb;border-bottom:1px solid #e5e7eb;">
    <div class="container">
        <div class="features-grid">
            <div class="feature-item">
                <div class="feature-icon c-success" style="background:#16a34a !important;color:#fff !important;border-radius:50%;width:52px;height:52px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(22,163,74,.2);"><i class="fas fa-truck-fast"></i></div>
                <div>
                    <div class="feature-title">Free Delivery</div>
                    <div class="feature-sub">On orders over ₹49</div>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon c-secondary" style="background:#ef4444 !important;color:#fff !important;border-radius:50%;width:52px;height:52px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(239,68,68,.2);"><i class="fas fa-rotate-left"></i></div>
                <div>
                    <div class="feature-title">Easy Returns</div>
                    <div class="feature-sub">7-day money back</div>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon c-warning" style="background:#f59e0b !important;color:#fff !important;border-radius:50%;width:52px;height:52px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(245,158,11,.2);"><i class="fas fa-shield-halved"></i></div>
                <div>
                    <div class="feature-title">Secure Payment</div>
                    <div class="feature-sub">100% protected</div>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon c-info" style="background:#3b82f6 !important;color:#fff !important;border-radius:50%;width:52px;height:52px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(59,130,246,.2);"><i class="fas fa-headset"></i></div>
                <div>
                    <div class="feature-title">24/7 Support</div>
                    <div class="feature-sub">Always here to help</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── Category Circles ── --}}
<section class="section-pad" style="background:white;">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="section-eyebrow"><i class="fas fa-grid-2"></i> Browse by Category</div>
                <h2 class="section-title">Shop by Category</h2>
            </div>
            <a href="{{ route('products') }}" class="btn btn-secondary">View All <i class="fas fa-arrow-right"></i></a>
        </div>

        <div class="swiper circular-cat-swiper" style="padding-bottom:8px;">
            <div class="swiper-wrapper">
                @foreach($categories as $category)
                <div class="swiper-slide" style="text-align:center;">
                    <a href="{{ route('products', ['category' => $category->slug]) }}" class="cat-circle-item">
                        <div class="cat-circle-ring">
                            <img src="{{ $category->imageUrl['250'] ?? 'https://images.unsplash.com/photo-1543168256-418811576931?auto=format&fit=crop&w=300&q=80' }}"
                                 alt="{{ $category->title }}" loading="lazy">
                        </div>
                        <div class="cat-circle-name">{{ $category->title }}</div>
                        <div class="cat-circle-count">{{ $category->products_count ?? rand(10,80) }} items</div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ── Promo Banners ── --}}
<section class="section-pad-sm" style="background:var(--gray-50);">
    <div class="container">
        <div style="display:grid;grid-template-columns:2fr 1fr;gap:20px;">
            <!-- Big Banner -->
            <div class="promo-banner" style="min-height:240px;background:linear-gradient(135deg,#052e16 0%,#14532d 100%);">
                <div class="promo-banner-overlay" style="background:linear-gradient(90deg,rgba(5,46,22,.95) 0%,transparent 70%);">
                    <span class="promo-banner-tag" style="background:var(--secondary);color:white;">🔥 Flash Sale</span>
                    <h3 class="promo-banner-title" style="font-size:1.8rem;">Up to <span style="color:var(--yellow-light);">40% OFF</span><br>on Organic Produce</h3>
                    <p class="promo-banner-sub">Fresh from local farms. Limited time offer!</p>
                    <a href="{{ route('products') }}" class="btn btn-orange" style="margin-top:16px;">Shop the Sale <i class="fas fa-arrow-right"></i></a>
                </div>
                <img src="https://images.unsplash.com/photo-1488459716781-31db52582fe9?auto=format&fit=crop&w=800&q=80" alt="Organic" style="opacity:.35;">
            </div>

            <!-- Small Banners Stack -->
            <div style="display:flex;flex-direction:column;gap:20px;">
                <div class="promo-banner" style="min-height:106px;background:linear-gradient(135deg,#0d9488 0%,#0f766e 100%);">
                    <div class="promo-banner-overlay" style="background:linear-gradient(90deg,rgba(13,148,136,.9),transparent);">
                        <span class="promo-banner-tag" style="background:white;color:var(--teal-primary);">🥛 Dairy Fresh</span>
                        <h3 class="promo-banner-title" style="font-size:1rem;">Daily Essentials<br><span style="color:var(--yellow-light);font-size:.85rem;">20% Off Today</span></h3>
                    </div>
                    <img src="https://images.unsplash.com/photo-1550583724-b2692b85b150?auto=format&fit=crop&w=400&q=80" alt="Dairy" style="opacity:.3;">
                </div>
                <div class="promo-banner" style="min-height:106px;background:linear-gradient(135deg,#7c3aed 0%,#6d28d9 100%);">
                    <div class="promo-banner-overlay" style="background:linear-gradient(90deg,rgba(124,58,237,.9),transparent);">
                        <span class="promo-banner-tag" style="background:var(--yellow-primary);color:white;">🍞 Bakery</span>
                        <h3 class="promo-banner-title" style="font-size:1rem;">Artisan Breads<br><span style="color:var(--yellow-light);font-size:.85rem;">Baked Fresh Daily</span></h3>
                    </div>
                    <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=400&q=80" alt="Bakery" style="opacity:.3;">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── New Arrivals ── --}}
<section class="section-pad" style="background:white;">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="section-eyebrow"><i class="fas fa-sparkles"></i> Just In</div>
                <h2 class="section-title">New Arrivals</h2>
                <p style="color:var(--gray-500);font-size:.85rem;margin-top:6px;">Fresh additions to our store this week.</p>
            </div>
            <div class="section-nav">
                <button class="btn-icon latest-prev"><i class="fas fa-chevron-left"></i></button>
                <button class="btn-icon latest-next"><i class="fas fa-chevron-right"></i></button>
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
                    <div class="swiper-slide">
                        @include('frontend.components.product-card', ['product' => null, 'static_index' => $i])
                    </div>
                    @endfor
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- ── Featured Products ── --}}
<section class="section-pad" style="background:var(--gray-50);">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="section-eyebrow" style="color:var(--secondary);"><i class="fas fa-fire"></i> Handpicked</div>
                <h2 class="section-title">Featured Collection</h2>
            </div>
            <div class="section-nav">
                <button class="btn-icon featured-prev"><i class="fas fa-chevron-left"></i></button>
                <button class="btn-icon featured-next"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
        <div class="swiper featured-product-swiper">
            <div class="swiper-wrapper">
                @forelse($featuredProducts as $product)
                <div class="swiper-slide">@include('frontend.components.product-card', ['product' => $product])</div>
                @empty
                    @for($i = 1; $i <= 10; $i++)
                    <div class="swiper-slide">@include('frontend.components.product-card', ['product' => null, 'static_index' => $i + 10])</div>
                    @endfor
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- ── Value Props Banner ── --}}
<section style="background:var(--grad-secondary);padding:56px 0;color:white;">
    <div class="container">
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:32px;text-align:center;">
            <div>
                <i class="fas fa-seedling" style="font-size:2.2rem;margin-bottom:12px;display:block;opacity:.9;"></i>
                <div style="font-size:1rem;font-weight:900;margin-bottom:6px;">Quality Guaranteed</div>
                <div style="font-size:.78rem;opacity:.75;font-weight:500;">All products meet organic standards</div>
            </div>
            <div>
                <i class="fas fa-bolt" style="font-size:2.2rem;margin-bottom:12px;display:block;opacity:.9;color:var(--yellow-light);"></i>
                <div style="font-size:1rem;font-weight:900;margin-bottom:6px;">Same-Day Delivery</div>
                <div style="font-size:.78rem;opacity:.75;font-weight:500;">Order before 2pm for same-day</div>
            </div>
            <div>
                <i class="fas fa-snowflake" style="font-size:2.2rem;margin-bottom:12px;display:block;opacity:.9;color:#bfdbfe;"></i>
                <div style="font-size:1rem;font-weight:900;margin-bottom:6px;">Secure Packaging</div>
                <div style="font-size:.78rem;opacity:.75;font-weight:500;">Always fresh, always cold</div>
            </div>
            <div>
                <i class="fas fa-handshake" style="font-size:2.2rem;margin-bottom:12px;display:block;opacity:.9;color:#bbf7d0;"></i>
                <div style="font-size:1rem;font-weight:900;margin-bottom:6px;">Direct from Brands</div>
                <div style="font-size:.78rem;opacity:.75;font-weight:500;">Supporting local agriculture</div>
            </div>
        </div>
    </div>
</section>

{{-- ── Best Sellers ── --}}
<section class="section-pad" style="background:white;">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="section-eyebrow" style="color:var(--teal-primary);"><i class="fas fa-crown"></i> Most Loved</div>
                <h2 class="section-title">Best Sellers</h2>
            </div>
            <div class="section-nav">
                <button class="btn-icon top-prev"><i class="fas fa-chevron-left"></i></button>
                <button class="btn-icon top-next"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
        <div class="swiper top-product-swiper">
            <div class="swiper-wrapper">
                @forelse($bestSellers as $product)
                <div class="swiper-slide">@include('frontend.components.product-card', ['product' => $product])</div>
                @empty
                    @for($i = 1; $i <= 10; $i++)
                    <div class="swiper-slide">@include('frontend.components.product-card', ['product' => null, 'static_index' => $i + 20])</div>
                    @endfor
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- ── Testimonials ── --}}
<section class="section-pad" style="background:var(--gray-50);">
    <div class="container">
        <div class="section-head">
            <div>
                <div class="section-eyebrow" style="color:var(--yellow-primary);"><i class="fas fa-star"></i> Reviews</div>
                <h2 class="section-title">What Our Customers Say</h2>
            </div>
            <div class="section-nav">
                <button class="btn-icon review-prev"><i class="fas fa-chevron-left"></i></button>
                <button class="btn-icon review-next"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>

        <div class="swiper review-swiper">
            <div class="swiper-wrapper">
                @forelse($testimonials as $testimonial)
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-text">"{{ $testimonial->content }}"</p>
                        <div class="testimonial-author">
                            <img src="{{ $testimonial->avatar_url }}" class="testimonial-avatar" alt="{{ $testimonial->name }}">
                            <div>
                                <div class="testimonial-name">{{ $testimonial->name }}</div>
                                <div class="testimonial-role">{{ $testimonial->role }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    @foreach([['Emma R.','Verified Buyer','The freshness of the produce is incredible. My salads have never tasted this good!'],['James K.','Regular Customer','Super fast delivery and everything was perfectly packaged. Highly recommend!'],['Sarah L.','Food Blogger','The organic range is outstanding. Supporting local farmers while eating well — perfect.']] as $t)
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-stars">★★★★★</div>
                            <p class="testimonial-text">"{{ $t[2] }}"</p>
                            <div class="testimonial-author">
                                <img src="https://i.pravatar.cc/80?u={{ $loop->index }}" class="testimonial-avatar" alt="{{ $t[0] }}">
                                <div>
                                    <div class="testimonial-name">{{ $t[0] }}</div>
                                    <div class="testimonial-role">{{ $t[1] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Hero Slider
    let currentSlide = 0;
    const slides = document.querySelectorAll('[data-slide]');
    const dots   = document.querySelectorAll('[data-dot]');
    if (slides.length > 1) {
        function goTo(n) {
            slides[currentSlide].style.opacity = 0;
            dots[currentSlide].classList.remove('active');
            currentSlide = n;
            slides[currentSlide].style.opacity = 1;
            dots[currentSlide].classList.add('active');
        }
        dots.forEach(d => d.addEventListener('click', () => goTo(+d.dataset.dot)));
        setInterval(() => goTo((currentSlide + 1) % slides.length), 5500);
    }

    // Category Swiper
    new Swiper('.circular-cat-swiper', {
        slidesPerView: 3, spaceBetween: 16,
        breakpoints: { 480:{slidesPerView:4}, 768:{slidesPerView:5}, 1024:{slidesPerView:7} }
    });

    // Product Swipers
    const prodOpts = (prev, next) => ({
        slidesPerView: 2, spaceBetween: 16,
        grid: { rows: 2, fill: 'row' },
        navigation: { nextEl: next, prevEl: prev },
        breakpoints: { 640:{slidesPerView:2}, 1024:{slidesPerView:4, spaceBetween:20} }
    });
    new Swiper('.latest-product-swiper',   prodOpts('.latest-prev',   '.latest-next'));
    new Swiper('.featured-product-swiper', prodOpts('.featured-prev', '.featured-next'));
    new Swiper('.top-product-swiper',      prodOpts('.top-prev',      '.top-next'));

    // Review Swiper
    new Swiper('.review-swiper', {
        slidesPerView: 1, spaceBetween: 24, loop: true,
        autoplay: { delay: 5000 },
        navigation: { nextEl: '.review-next', prevEl: '.review-prev' },
        breakpoints: { 768:{slidesPerView:2}, 1024:{slidesPerView:3} }
    });
});
</script>
@endpush
