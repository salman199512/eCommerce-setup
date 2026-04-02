{{-- ══════════════════════════════════════════════
     FreshMart Premium Header — Multi-Color UI
══════════════════════════════════════════════ --}}

<!-- ── Top Announcement Bar ── -->
<div class="topbar">
    <div class="container">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;">
            <div class="topbar-marquee">
                <span class="topbar-item"><i class="fas fa-truck-fast"></i> Free delivery on orders over ₹49</span>
                <span class="topbar-item" style="opacity:.4;">|</span>
                <span class="topbar-item"><i class="fas fa-leaf"></i> 100% Organic &amp; Fresh</span>
                <span class="topbar-item" style="opacity:.4;">|</span>
                <span class="topbar-item"><i class="fas fa-rotate-left"></i> 7-Day Easy Returns</span>
            </div>
            <div class="topbar-links">
                <a href="{{ route('my-account') }}"><i class="far fa-user" style="margin-right:4px;"></i>Account</a>
                <a href="{{ route('my-orders') }}"><i class="fas fa-box" style="margin-right:4px;"></i>Track Order</a>
            </div>
        </div>
    </div>
</div>

<!-- ── Main Site Header ── -->
<header class="site-header" id="site-header" style="height:84px !important;">
    <div class="container">
        <div class="header-inner">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="site-logo">
                <div class="logo-icon">
                    <i class="fas fa-seedling"></i>
                </div>
                <div>
                    <div class="logo-text-top">Shop<span>Zone</span></div>
                    <div class="logo-text-bottom">Premium Store</div>
                </div>
            </a>

            <!-- Search Bar -->
            <div class="header-search">
                <form action="{{ route('products') }}" method="GET" class="search-form-wrap" autocomplete="off">
                    <div class="header-search-inner">
                        @php $cats = $sharedCategories ?? collect(); @endphp
                        <select class="search-category-select" name="category" style="min-width:110px;">
                            <option value="">All Categories</option>
                            @foreach($cats as $cat)
                            <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                {{ $cat->title }}
                            </option>
                            @endforeach
                        </select>
                        <input type="text" name="search" id="global-search-input" class="search-input"
                               placeholder="Search fresh groceries, brands, products…"
                               value="{{ request('search') }}">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                            <span style="display:none;" class="d-md-inline">Search</span>
                        </button>
                    </div>

                    <!-- Search Suggestions Dropdown -->
                    <div id="search-suggestions" class="search-dropdown" style="display:none;">
                        <div class="search-dropdown-header">Quick Results</div>
                        <div id="suggestion-results"></div>
                    </div>
                </form>
            </div>

            <!-- Header Actions -->
            <div class="header-actions">
                <!-- Account -->
                <div style="position:relative;">
                    <a href="{{ route('my-account') }}" class="header-action-btn">
                        <i class="far fa-user"></i>
                        <span class="label">Account</span>
                    </a>
                    @auth
                    <div class="cart-dropdown" style="min-width:220px;left:auto;right:0;">
                        <div class="cart-dropdown-head" style="background:var(--grad-hero);color:white;border-radius:var(--radius-xl) var(--radius-xl) 0 0;">
                            <div>
                                <div style="font-size:.68rem;opacity:.7;font-weight:600;">Welcome back</div>
                                <div style="font-weight:800;font-size:.85rem;">{{ auth()->user()->name }}</div>
                            </div>
                            <i class="fas fa-user-circle" style="font-size:1.6rem;opacity:.5;"></i>
                        </div>
                        <div style="padding:8px 0;">
                            <a href="{{ route('my-account') }}" class="account-nav-link"><i class="fas fa-gauge"></i> Dashboard</a>
                            <a href="{{ route('my-orders') }}" class="account-nav-link"><i class="fas fa-box"></i> My Orders</a>
                            <a href="{{ route('wishlist') }}" class="account-nav-link"><i class="fas fa-heart"></i> Wishlist</a>
                            <a href="{{ route('my-account.profile') }}" class="account-nav-link"><i class="fas fa-gear"></i> Profile Settings</a>
                        </div>
                        <div style="padding:12px 20px;border-top:1px solid var(--gray-100);">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-sm" style="width:100%;background:var(--red-soft);color:var(--red-primary);border:none;">
                                    <i class="fas fa-right-from-bracket"></i> Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                    @endauth
                </div>

                <!-- Wishlist -->
                <a href="{{ route('wishlist') }}" class="header-action-btn" style="position:relative;">
                    <i class="far fa-heart"></i>
                    <span class="label">Wishlist</span>
                    @auth
                    <span class="cart-badge" style="background:var(--red-primary);">{{ auth()->user()->wishlists()->count() }}</span>
                    @else
                    <span class="cart-badge" style="background:var(--red-primary);">0</span>
                    @endauth
                </a>

                <!-- Cart -->
                <div class="cart-dropdown-wrap">
                    <a href="{{ route('cart') }}" class="header-action-btn no-bg" style="background:transparent !important;border:none !important;">
                        @php $cart = session('cart', []); $totalQty = array_sum(array_column($cart, 'quantity')); @endphp
                        <i class="fas fa-cart-shopping"></i>
                        <span class="label" style="color:var(--primary);">Cart</span>
                        <span class="cart-badge cart-count-global">{{ $totalQty }}</span>
                    </a>

                    <!-- Mini Cart Dropdown -->
                    <div class="cart-dropdown">
                        <div class="cart-dropdown-head">
                            <span class="cart-dropdown-title">Shopping Cart</span>
                            <span class="cart-dropdown-count"><span class="cart-items-count">{{ count($cart) }}</span> items</span>
                        </div>

                        @php $cartFull = session('cart', []); $cartTotal = 0; @endphp
                        @if(count($cartFull) > 0)
                        <div class="cart-dropdown-body scrollbar-hide">
                            @foreach($cartFull as $id => $details)
                            @php $cartTotal += $details['price'] * $details['quantity']; @endphp
                            <div class="cart-item-row">
                                <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" class="cart-item-img">
                                <div style="flex:1;min-width:0;">
                                    <div class="cart-item-name">{{ Str::limit($details['name'], 30) }}</div>
                                    <div class="cart-item-meta">{{ $details['quantity'] }} × ₹{{ number_format($details['price'], 2) }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="cart-dropdown-footer">
                            <div class="cart-subtotal-row">
                                <span class="cart-subtotal-label">Subtotal</span>
                                <span class="cart-subtotal-amount">₹{{ number_format($cartTotal, 2) }}</span>
                            </div>
                            <div class="cart-actions">
                                <a href="{{ route('checkout') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-lock"></i> Secure Checkout
                                </a>
                                <a href="{{ route('cart') }}" class="btn btn-secondary btn-block btn-sm">
                                    View Cart
                                </a>
                            </div>
                        </div>
                        @else
                        <div style="padding:40px 20px;text-align:center;color:var(--gray-400);">
                            <i class="fas fa-cart-shopping" style="font-size:2.5rem;margin-bottom:12px;display:block;opacity:.2;"></i>
                            <p style="font-size:.78rem;font-weight:700;margin-bottom:16px;">Your cart is empty</p>
                            <a href="{{ route('products') }}" class="btn btn-primary btn-sm">Shop Now</a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Mobile Menu -->
                <button class="mobile-menu-btn" id="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- ── Navigation Bar ── -->
<nav class="site-nav" id="site-nav">
    <div class="container">
        <div class="nav-inner">
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="fas fa-house"></i> Home
                    </a>
                </li>

                <!-- Categories Mega -->
                <li class="nav-item">
                    <a href="{{ route('products') }}" class="nav-link {{ request()->routeIs('products') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i>
                        Categories <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="mega-menu">
                        <div class="container" style="display:grid;grid-template-columns:1fr 280px;gap:20px;padding:0;">
                            <div class="mega-menu-inner">
                                @foreach($cats as $cat)
                                    @if($cat->subCategories->count() > 0)
                                    <div>
                                        <div class="mega-col-title">{{ $cat->title }}</div>
                                        <div class="mega-col-links">
                                            @foreach($cat->subCategories->take(8) as $sub)
                                            <a href="{{ route('products', ['category' => $cat->slug, 'sub_category' => $sub->slug]) }}">
                                                <i class="fas fa-circle" style="font-size:.25rem;color:var(--primary);"></i>
                                                {{ $sub->title }}
                                            </a>
                                            @endforeach
                                            <a href="{{ route('products', ['category' => $cat->slug]) }}" style="color:var(--primary);font-weight:800;font-size:.7rem;text-transform:uppercase;letter-spacing:.08em;margin-top:5px;">
                                                View All →
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="mega-promo">
                                <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=600&q=80" alt="Fresh Produce">
                                <div class="mega-promo-content">
                                    <span class="mega-promo-tag">🌱 Organic</span>
                                    <div style="font-size:1.3rem;font-weight:900;color:white;line-height:1.2;margin-bottom:6px;">Farm Fresh<br>Delivered</div>
                                    <a href="{{ route('products') }}" class="btn btn-white btn-sm" style="margin-top:12px;">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('products') }}" class="nav-link">
                        <i class="fas fa-fire" style="color:var(--orange-primary);"></i> Deals
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products') }}" class="nav-link">
                        <i class="fas fa-star" style="color:var(--yellow-primary);"></i> Best Sellers
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products') }}" class="nav-link">
                        <i class="fas fa-leaf" style="color:var(--teal-primary);"></i> Organic
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('about-us') }}" class="nav-link {{ request()->routeIs('about-us') ? 'active' : '' }}">
                        <i class="fas fa-info-circle"></i> About
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact-us') }}" class="nav-link {{ request()->routeIs('contact-us') ? 'active' : '' }}">
                        <i class="fas fa-headset"></i> Contact
                    </a>
                </li>
            </ul>

            <!-- Delivery Info -->
            <div class="nav-delivery" style="flex-shrink:0;">
                <i class="fas fa-location-dot"></i>
                <div class="nav-delivery-text">
                    <span class="label">Deliver to</span>
                    <span class="value">Your Location</span>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- ── Mobile Drawer ── -->
<div class="mobile-drawer-overlay" id="mobile-overlay"></div>
<div class="mobile-drawer" id="mobile-drawer">
    <div class="mobile-drawer-head">
        <div class="site-logo" style="gap:8px;">
            <div class="logo-icon" style="width:32px;height:32px;font-size:.9rem;"><i class="fas fa-seedling"></i></div>
            <div class="logo-text-top" style="font-size:1.1rem;"<>Shop<span>Zone</span></div>
        </div>
        <button class="mobile-close-btn" id="mobile-close-btn"><i class="fas fa-times"></i></button>
    </div>

    <!-- Mobile Search -->
    <div style="padding:16px;border-bottom:1px solid var(--border-light);">
        <form action="{{ route('products') }}" method="GET">
            <div style="position:relative;">
                <input type="text" name="search" class="fm-input" placeholder="Search products…" style="padding-right:44px;">
                <button type="submit" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--primary);font-size:1rem;">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Mobile Nav -->
    <nav style="padding:8px 0;">
        <a href="{{ route('home') }}" class="mobile-nav-link">
            <span>Home</span><i class="fas fa-chevron-right" style="font-size:.65rem;"></i>
        </a>

        <!-- Categories Accordion -->
        <div id="mobile-cats-toggle" class="mobile-nav-link" style="cursor:pointer;">
            <span>Categories</span>
            <i class="fas fa-chevron-down" style="font-size:.65rem;transition:transform .3s;" id="cats-chevron"></i>
        </div>
        <div class="mobile-submenu" id="mobile-cats-submenu">
            @foreach($cats as $cat)
            <a href="{{ route('products', ['category' => $cat->slug]) }}">{{ $cat->title }}</a>
            @foreach($cat->subCategories as $sub)
            <a href="{{ route('products', ['category' => $cat->slug, 'sub_category' => $sub->slug]) }}" style="padding-left:50px;font-size:.72rem;color:var(--gray-400);">↳ {{ $sub->title }}</a>
            @endforeach
            @endforeach
        </div>

        <a href="{{ route('products') }}" class="mobile-nav-link"><span>Deals</span><i class="fas fa-chevron-right" style="font-size:.65rem;"></i></a>
        <a href="{{ route('products') }}" class="mobile-nav-link"><span>Best Sellers</span><i class="fas fa-chevron-right" style="font-size:.65rem;"></i></a>
        <a href="{{ route('about-us') }}" class="mobile-nav-link"><span>About Us</span><i class="fas fa-chevron-right" style="font-size:.65rem;"></i></a>
        <a href="{{ route('contact-us') }}" class="mobile-nav-link"><span>Contact</span><i class="fas fa-chevron-right" style="font-size:.65rem;"></i></a>
    </nav>

    <!-- Mobile User Actions -->
    <div style="padding:20px;border-top:1px solid var(--border-light);margin-top:auto;display:flex;flex-direction:column;gap:10px;">
        <a href="{{ route('my-account') }}" class="btn btn-primary"><i class="far fa-user"></i> My Account</a>
        <a href="{{ route('wishlist') }}" class="btn btn-secondary"><i class="far fa-heart"></i> Wishlist</a>
        <a href="{{ route('cart') }}" class="btn btn-dark"><i class="fas fa-cart-shopping"></i> Cart ({{ $totalQty }})</a>
    </div>
</div>

<style>
/* Mobile drawer bridge */
.mobile-drawer-overlay.open { display: block; }
.mobile-drawer.open { transform: translateX(0); }

/* Scroll active nav highlight */
.site-header.scrolled {
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}
</style>

<script>
(function() {
    const overlay = document.getElementById('mobile-overlay');
    const drawer  = document.getElementById('mobile-drawer');
    const openBtn = document.getElementById('mobile-menu-btn');
    const closeBtn = document.getElementById('mobile-close-btn');

    function openDrawer() {
        overlay.style.display = 'block';
        document.body.style.overflow = 'hidden';
        setTimeout(() => { overlay.classList.add('open'); drawer.classList.add('open'); }, 10);
    }
    function closeDrawer() {
        overlay.classList.remove('open');
        drawer.classList.remove('open');
        setTimeout(() => { overlay.style.display = 'none'; document.body.style.overflow = ''; }, 400);
    }

    if (openBtn) openBtn.addEventListener('click', openDrawer);
    if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
    if (overlay) overlay.addEventListener('click', closeDrawer);

    // Categories accordion
    const catsToggle = document.getElementById('mobile-cats-toggle');
    const catsSubmenu = document.getElementById('mobile-cats-submenu');
    const catsChevron = document.getElementById('cats-chevron');
    if (catsToggle) {
        catsToggle.addEventListener('click', () => {
            catsSubmenu.classList.toggle('open');
            catsChevron.style.transform = catsSubmenu.classList.contains('open') ? 'rotate(180deg)' : '';
        });
    }

    // Sticky header
    const header = document.getElementById('site-header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 60) header.classList.add('scrolled');
        else header.classList.remove('scrolled');
    });

    // Search suggestions
    let searchTimeout;
    const $searchInput = $('#global-search-input');
    const $suggestions = $('#search-suggestions');
    const $results     = $('#suggestion-results');

    $searchInput.on('input', function() {
        clearTimeout(searchTimeout);
        const q = this.value.trim();
        if (q.length < 2) { $suggestions.hide(); return; }

        searchTimeout = setTimeout(() => {
            $.ajax({
                url: "{{ route('search.suggestions') }}",
                data: { q },
                success: function(data) {
                    if (data.length) {
                        let html = data.map(item => `
                            <a href="/product/${item.slug}" class="search-item">
                                <img src="${item.image || 'https://via.placeholder.com/60'}" class="search-item-img" alt="${item.title}">
                                <div>
                                    <div class="search-item-name">${item.title}</div>
                                    <div class="search-item-price">₹${parseFloat(item.price||0).toFixed(2)}</div>
                                </div>
                                <i class="fas fa-chevron-right" style="font-size:.6rem;color:var(--gray-300);margin-left:auto;"></i>
                            </a>
                        `).join('');
                        $results.html(html);
                        $suggestions.show();
                    } else {
                        $suggestions.hide();
                    }
                }
            });
        }, 280);
    });

    $(document).on('click', e => {
        if (!$(e.target).closest('.search-form-wrap').length) $suggestions.hide();
    });
    $(document).on('keydown', e => { if (e.key === 'Escape') $suggestions.hide(); });
})();
</script>
