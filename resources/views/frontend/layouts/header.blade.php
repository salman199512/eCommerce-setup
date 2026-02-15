
<!-- Top Bar -->
<div class="bg-black text-white text-[10px] py-2 border-b border-gray-800">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <div class="flex space-x-6 text-gray-400">
            <span class="hover:text-white cursor-pointer transition flex items-center gap-2"><i class="fa fa-phone text-[8px]"></i> +1 123 456 7890</span>
            <span class="hover:text-white cursor-pointer transition flex items-center gap-2"><i class="fa fa-envelope text-[8px]"></i> support@fashion.com</span>
        </div>
        <div class="hidden md:flex space-x-4">
             <div class="relative group cursor-pointer">
                <span class="hover:text-white flex items-center gap-1">English <i class="fa fa-angle-down text-[8px]"></i></span>
                <div class="absolute right-0 mt-2 w-32 bg-white text-black shadow-2xl hidden group-hover:block z-[100] rounded overflow-hidden border border-gray-100 animate-fadeInScale">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-50 text-[10px] font-bold uppercase transition">English</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-50 text-[10px] font-bold uppercase transition">French</a>
                </div>
            </div>
             <div class="relative group cursor-pointer">
                <span class="hover:text-white flex items-center gap-1">USD <i class="fa fa-angle-down text-[8px]"></i></span>
                <div class="absolute right-0 mt-2 w-32 bg-white text-black shadow-2xl hidden group-hover:block z-[100] rounded overflow-hidden border border-gray-100 animate-fadeInScale">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-50 text-[10px] font-bold uppercase transition">USD</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-50 text-[10px] font-bold uppercase transition">EUR</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Header -->
<header class="bg-white sticky top-0 z-50 border-b border-gray-100 shadow-sm" id="main-header">
    <div class="container mx-auto px-4 py-3 md:py-4">
        <div class="flex items-center justify-between gap-4">

            <!-- Logo (Left) -->
            <div class="flex items-center shrink-0">
                <a href="{{ route('home') }}" class="group flex items-center">
                    <div class="relative">
                        <span class="text-2xl md:text-3xl font-black tracking-tighter text-black uppercase">
                            Fashion<span class="text-red-600">.</span>
                        </span>
                        <div class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-600 transition-all duration-300 group-hover:w-full"></div>
                    </div>
                </a>
            </div>

            <!-- Search Bar (Center) -->
            <div class="hidden lg:flex flex-1 max-w-xl mx-8 relative">
                <form action="{{ route('products') }}" method="GET" class="w-full relative group search-form">
                    <input type="text" name="search" id="global-search-input" placeholder="Search for premium apparel..."
                           autocomplete="off"
                           class="w-full bg-gray-50 border border-gray-100 py-3 px-6 pr-12 focus:bg-white focus:ring-4 focus:ring-black/5 focus:border-black transition-all rounded-full text-xs font-medium placeholder-gray-400 outline-none">
                    <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 w-8 h-8 flex items-center justify-center text-gray-400 hover:text-black transition-colors">
                        <i class="fa fa-search text-sm"></i>
                    </button>

                    <!-- Search Suggestions Container -->
                    <div id="search-suggestions" class="absolute top-[calc(100%+10px)] left-0 w-full bg-white shadow-2xl rounded-2xl border border-gray-100 hidden z-[60] overflow-hidden animate-fadeInUpSmall pb-2">
                        <div class="p-4 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Quick Results</span>
                            <span class="text-[9px] text-gray-300">Press Esc to close</span>
                        </div>
                        <div id="suggestion-results" class="max-h-[400px] overflow-y-auto custom-scrollbar">
                            <!-- Results inject here -->
                        </div>
                    </div>
                </form>
            </div>

            <!-- Icons & Actions (Right) -->
            <div class="flex items-center space-x-6 md:space-x-8 text-black">
                <!-- Mobile Search Trigger -->
                <button class="lg:hidden hover:text-red-600 transition-colors">
                    <i class="fa fa-search text-lg"></i>
                </button>

                <div class="relative group">
                    <a href="{{ route('my-account') }}" class="group relative hover:text-red-600 transition-colors flex flex-col items-center">
                        <i class="far fa-user text-xl"></i>
                        <span class="text-[8px] uppercase font-bold tracking-premium mt-1.5 hidden md:block group-hover:opacity-100 opacity-60">Identity</span>
                    </a>
                    @auth
                    <!-- Invisible bridge to keep dropdown open -->
                    <div class="absolute right-0 top-full h-2 w-48 hidden group-hover:block z-40"></div>
                    <div class="absolute right-0 top-full mt-2 w-48 bg-white shadow-2xl border border-gray-100 hidden group-hover:block z-50 rounded-xl overflow-hidden animate-fadeInScale">
                        <div class="p-4 bg-gray-50 border-b">
                            <p class="text-[10px] font-black uppercase text-gray-400 mb-1">Welcome back</p>
                            <p class="text-xs font-bold truncate">{{ auth()->user()->name }}</p>
                        </div>
                        <a href="{{ route('my-account') }}" class="block px-4 py-3 text-xs font-bold text-gray-700 hover:bg-gray-50 transition border-b">Dashboard</a>
                        <a href="{{ route('my-orders') }}" class="block px-4 py-3 text-xs font-bold text-gray-700 hover:bg-gray-50 transition border-b">My Orders</a>
                        <a href="{{ route('wishlist') }}" class="block px-4 py-3 text-xs font-bold text-gray-700 hover:bg-gray-50 transition border-b">Wishlist</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-3 text-xs font-bold text-red-600 hover:bg-red-50 transition">Sign Out</button>
                        </form>
                    </div>
                    @endauth
                </div>

                <a href="{{ route('wishlist') }}" class="group relative hover:text-red-600 transition-colors flex flex-col items-center">
                    <i class="far fa-heart text-xl"></i>
                    @auth
                        <span class="absolute -top-1 -right-2 bg-red-600 text-white rounded-full text-[8px] w-3.5 h-3.5 flex items-center justify-center font-bold">
                            {{ auth()->user()->wishlists()->count() }}
                        </span>
                    @else
                        <span class="absolute -top-1 -right-2 bg-red-600 text-white rounded-full text-[8px] w-3.5 h-3.5 flex items-center justify-center font-bold">0</span>
                    @endauth
                    <span class="text-[8px] uppercase font-bold tracking-premium mt-1.5 hidden md:block group-hover:opacity-100 opacity-60">Favorites</span>
                </a>

                <div class="relative group py-2"> <!-- Added padding for bridge -->
                    <a href="{{ route('cart') }}" class="relative hover:text-red-600 transition-colors flex flex-col items-center">
                        <i class="fas fa-shopping-bag text-xl"></i>
                        @php $cart = session('cart', []); $totalQty = array_sum(array_column($cart, 'quantity')); @endphp
                        <span class="absolute -top-1 -right-2 bg-black text-white rounded-full text-[8px] w-3.5 h-3.5 flex items-center justify-center font-bold cart-count-global">{{ $totalQty }}</span>
                        <span class="text-[8px] uppercase font-bold tracking-premium mt-1.5 hidden md:block group-hover:opacity-100 opacity-60">Bag</span>
                    </a>

                    <!-- Mini Cart Dropdown -->
                    <div class="absolute right-0 top-[100%] w-80 bg-white shadow-2xl border border-gray-100 hidden group-hover:block z-50 p-6 rounded-2xl text-left text-gray-800 animate-fadeInScale mt-4 dropdown-bridge">
                        <div class="flex items-center justify-between mb-6 border-b pb-4">
                            <h4 class="text-xs font-black uppercase tracking-widest">Shopping Bag</h4>
                            <span class="text-[10px] font-bold text-gray-400"><span class="cart-items-count">{{ count($cart) }}</span> Items</span>
                        </div>

                        @php $cart = session('cart', []); $total = 0; @endphp
                        @if(count($cart) > 0)
                            <div class="max-h-80 overflow-y-auto mb-6 space-y-5 pr-2 custom-scrollbar">
                                @foreach($cart as $id => $details)
                                    @php $total += $details['price'] * $details['quantity']; @endphp
                                    <div class="flex items-center gap-4 group/item">
                                        <div class="w-16 h-20 bg-gray-50 rounded-xl overflow-hidden flex-shrink-0 relative">
                                            <img src="{{ $details['image'] }}" class="w-full h-full object-cover group-hover/item:scale-110 transition duration-700">
                                            <div class="absolute inset-0 bg-black/5 opacity-0 group-hover/item:opacity-100 transition"></div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-xs font-bold truncate text-gray-900 group-hover:text-red-600 transition">{{ $details['name'] }}</h4>
                                            <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-tighter">{{ $details['quantity'] }} × ${{ number_format($details['price'], 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="bg-gray-50 rounded-xl p-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Subtotal</span>
                                    <span class="text-lg font-black tracking-tighter">${{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <a href="{{ route('checkout') }}" class="block w-full bg-black text-white text-center py-4 text-[10px] font-black uppercase tracking-widest hover:bg-red-600 transition duration-300 rounded-xl">Secure Checkout</a>
                                <a href="{{ route('cart') }}" class="block w-full border border-gray-100 text-gray-400 text-center py-3 text-[9px] font-black uppercase tracking-widest hover:border-black hover:text-black transition duration-300 rounded-xl">View Bag</a>
                            </div>
                        @else
                            <div class="py-12 text-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-shopping-bag text-xl text-gray-200"></i>
                                </div>
                                <p class="text-[10px] text-gray-400 uppercase tracking-widest leading-relaxed">Your bag is currently<br>empty</p>
                                <a href="{{ route('products') }}" class="inline-block mt-6 text-[10px] font-black uppercase tracking-widest text-red-600 hover:text-black transition group">
                                    Explore Shop <i class="fa fa-arrow-right ml-1 transition group-hover:translate-x-1"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Mobile Menu Toggle -->
                <button class="md:hidden hover:text-red-600 transition-colors p-2" id="mobile-menu-btn">
                    <i class="fa fa-bars-staggered text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Navigation Bar -->
    <div class="hidden md:block border-t border-gray-50">
        <div class="container mx-auto px-4">
            <nav class="flex justify-center">
                <ul class="flex space-x-12 font-bold text-xs uppercase tracking-premium text-black">
                    <li class="relative group">
                        <a href="{{ route('home') }}" class="block py-5 hover:text-red-600 transition-colors">Home</a>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-red-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </li>

                    <!-- Full Width Mega Menu: Categories -->
                    @php $cats = $sharedCategories ?? collect(); @endphp
                    <li class="group"> <!-- Removed relative to allow full width -->
                        <a href="{{ route('products') }}" class="block py-5 hover:text-red-600 transition-colors flex items-center gap-1">
                            Categories <i class="fa fa-angle-down text-[8px] transition-transform duration-300 group-hover:rotate-180"></i>
                        </a>
                        <div class="container absolute left-0 right-0 mx-auto px-4"> <!-- Absolute positioning relative to header -->
                            <div class="absolute left-0 top-full w-full bg-white shadow-2xl hidden group-hover:block transition-all duration-300 z-40 border-t border-gray-100 animate-fadeInUpSmall rounded-b-3xl overflow-hidden dropdown-bridge">
                                <div class="grid grid-cols-12 max-w-7xl mx-auto">
                                    <div class="col-span-9 p-12">
                                        <div class="grid grid-cols-4 gap-12">
                                            @foreach($cats->take(4) as $cat)
                                            <div>
                                                <h4 class="font-black text-[11px] text-black mb-6 tracking-widest uppercase border-b border-gray-100 pb-3 flex items-center justify-between">
                                                    <a href="{{ route('products', ['category' => $cat->slug]) }}" class="hover:text-red-600 transition">{{ $cat->title }}</a>
                                                    <i class="fa fa-arrow-right text-[8px] opacity-0 group-hover:opacity-100 transition"></i>
                                                </h4>
                                                <ul class="space-y-4 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                                                    @foreach($cat->subCategories as $sub)
                                                        <li>
                                                            <a href="{{ route('products', ['category' => $cat->slug, 'sub_category' => $sub->slug]) }}"
                                                               class="hover:text-black transition-all hover:translate-x-2 inline-block flex items-center gap-2 group/sub">
                                                                <span class="w-1 h-1 bg-red-600 rounded-full opacity-0 group-hover/sub:opacity-100 transition"></span>
                                                                {{ $sub->title }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-span-3 bg-gray-50 p-10 relative overflow-hidden group/promo border-l border-gray-100">
                                        <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                                             class="absolute inset-0 w-full h-full object-cover opacity-90 group-hover/promo:scale-110 transition duration-1000">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                                        <div class="relative h-full flex flex-col justify-end text-white">
                                            <span class="text-[9px] font-black uppercase tracking-widest bg-red-600 w-fit px-3 py-1.5 mb-4 rounded-sm">Special Edition</span>
                                            <h3 class="text-3xl font-black leading-tight tracking-tighter mb-2 italic">Modern<br>Elegance</h3>
                                            <p class="text-[10px] text-gray-300 font-bold uppercase tracking-widest mb-6">Exclusively curated fashion</p>
                                            <a href="{{ route('products') }}" class="text-[10px] font-black uppercase tracking-widest w-fit group/btn flex items-center gap-2 bg-white text-black px-6 py-3 rounded-full hover:bg-red-600 hover:text-white transition duration-300">
                                                Explore <i class="fa fa-arrow-right text-[8px]"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="relative group">
                        <a href="{{ route('products') }}" class="block py-5 hover:text-red-600 transition-colors">Collections</a>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-red-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </li>
                    <li class="relative group">
                        <a href="{{ route('about-us') }}" class="block py-5 hover:text-red-600 transition-colors">House</a>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-red-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </li>
                    <li class="relative group">
                        <a href="{{ route('contact-us') }}" class="block py-5 hover:text-red-600 transition-colors">Support</a>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-red-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<!-- Mobile Menu Overlay -->
<div id="mobile-menu" class="hidden fixed inset-0 z-[60]">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm shadow-inner" id="close-mobile-menu-overlay"></div>
    <div class="absolute left-0 top-0 w-4/5 max-w-sm h-full bg-white shadow-2xl overflow-y-auto transform transition-all duration-300">
        <div class="p-6 flex justify-between items-center border-b">
             <span class="font-black text-2xl tracking-tighter uppercase">FASHION<span class="text-red-600">.</span></span>
             <button id="close-mobile-menu" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:text-black transition"><i class="fa fa-times"></i></button>
        </div>

        <div class="p-6">
            <form action="{{ route('products') }}" method="GET" class="relative mb-8">
                <input type="text" name="search" placeholder="Search..." class="w-full bg-gray-50 border-none py-4 px-5 rounded-2xl focus:ring-2 focus:ring-black/5 text-sm font-bold placeholder-gray-300">
                <button class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 hover:text-black transition"><i class="fa fa-search"></i></button>
            </form>

            <nav class="space-y-2">
                <a href="{{ route('home') }}" class="block py-4 px-4 font-black uppercase text-[11px] tracking-widest border-b border-gray-50 hover:text-red-600 transition">Home</a>

                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center py-4 px-4 font-black uppercase text-[11px] tracking-widest border-b border-gray-50 hover:text-red-600 transition">
                        Categories <i class="fa fa-angle-down transition-transform" :class="{'rotate-180': open}"></i>
                    </button>
                    <div x-show="open" x-transition class="pl-4 bg-gray-50 rounded-2xl mt-2 overflow-hidden">
                         @foreach($cats as $cat)
                         <div x-data="{ subOpen: false }" class="border-b border-white last:border-0">
                             <button @click="subOpen = !subOpen" class="w-full flex justify-between items-center py-4 px-4 text-[10px] font-black uppercase text-gray-500 hover:text-red-600 transition">
                                {{ $cat->title }} <i class="fa fa-plus text-[8px] transition-all" :class="{'rotate-45 text-red-600': subOpen}"></i>
                             </button>
                             <div x-show="subOpen" x-transition class="pl-6 pb-4 space-y-3">
                                  @foreach($cat->subCategories as $sub)
                                    <a href="{{ route('products', ['category' => $cat->slug, 'sub_category' => $sub->slug]) }}" class="block text-[10px] font-bold text-gray-400 hover:text-black transition tracking-wide italic">{{ $sub->title }}</a>
                                  @endforeach
                             </div>
                         </div>
                         @endforeach
                    </div>
                </div>

                <a href="{{ route('products') }}" class="block py-4 px-4 font-black uppercase text-[11px] tracking-widest border-b border-gray-50 hover:text-red-600 transition">Collections</a>
                <a href="{{ route('about-us') }}" class="block py-4 px-4 font-black uppercase text-[11px] tracking-widest border-b border-gray-50 hover:text-red-600 transition">Our Story</a>
                <a href="{{ route('contact-us') }}" class="block py-4 px-4 font-black uppercase text-[11px] tracking-widest border-b border-gray-50 hover:text-red-600 transition">Contact</a>
            </nav>

            <div class="mt-12 pt-8 border-t border-gray-50 space-y-4">
                <a href="{{ route('login') }}" class="flex items-center gap-4 py-3 px-4 rounded-xl bg-gray-50 text-gray-700 hover:bg-black hover:text-white transition duration-300">
                    <i class="far fa-user text-lg"></i> <span class="text-[10px] font-black uppercase tracking-widest">Account Login</span>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f8f9fa; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e9ecef; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #dee2e6; }

    .search-suggestion-item:hover .suggestion-img { transform: scale(1.1); }

    @keyframes fadeInUpSmall {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUpSmall { animation: fadeInUpSmall 0.3s ease forwards; }

    @keyframes fadeInScale {
        from { opacity: 0; transform: scale(0.95) translateY(10px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
    .animate-fadeInScale { animation: fadeInScale 0.2s ease-out forwards; }

    .dropdown-bridge::before {
        content: "";
        position: absolute;
        top: -20px;
        left: 0;
        right: 0;
        height: 25px;
        background: transparent;
        z-index: -1;
    }

    /* Premium Input Design */
    input[type="text"], input[type="email"], input[type="password"], input[type="number"], select, textarea {
        background-color: #f9fafb !important;
        border: 1px solid #c1c2c5 !important;
        padding: 12px 20px !important;
        border-radius: 12px !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        transition: all 0.3s ease !important;
        outline: none !important;
    }
    input:focus, select:focus, textarea:focus {
        background-color: #fff !important;
        border-color: #000 !important;
        box-shadow: 0 0 0 4px rgba(0,0,0,0.03) !important;
    }
</style>

<script>
    $(document).ready(function() {
        const mobileMenu = document.getElementById('mobile-menu');
        const openBtn = document.getElementById('mobile-menu-btn');
        const closeBtn = document.getElementById('close-mobile-menu');
        const closeOverlay = document.getElementById('close-mobile-menu-overlay');

        function toggleMenu() {
            mobileMenu.classList.toggle('hidden');
        }

        openBtn.addEventListener('click', toggleMenu);
        closeBtn.addEventListener('click', toggleMenu);
        closeOverlay.addEventListener('click', toggleMenu);

        // Search Auto-suggestion Logic
        let searchTimeout;
        const $searchInput = $('#global-search-input');
        const $suggestions = $('#search-suggestions');
        const $resultsList = $('#suggestion-results');

        $searchInput.on('input', function() {
            clearTimeout(searchTimeout);
            const query = $(this).val();

            if (query.length < 2) {
                $suggestions.addClass('hidden');
                return;
            }

            searchTimeout = setTimeout(function() {
                $.ajax({
                    url: "{{ route('search.suggestions') }}",
                    data: { q: query },
                    success: function(data) {
                        if (data.length > 0) {
                            let html = '';
                            data.forEach(function(item) {
                                html += `
                                    <a href="/product/${item.slug}" class="flex items-center gap-4 p-4 hover:bg-gray-50 transition border-b border-gray-50 last:border-0 group search-suggestion-item">
                                        <div class="w-12 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                            <img src="${item.image || 'https://via.placeholder.com/100x150'}" class="w-full h-full object-cover suggestion-img transition duration-500">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-xs font-bold text-gray-900 group-hover:text-red-600 transition truncate">${item.title}</h4>
                                            <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-widest font-black italic">$${parseFloat(item.price || 0).toFixed(2)}</p>
                                        </div>
                                        <i class="fa fa-chevron-right text-[8px] text-gray-200 group-hover:text-black transition"></i>
                                    </a>
                                `;
                            });
                            $resultsList.html(html);
                            $suggestions.removeClass('hidden');
                        } else {
                            $suggestions.addClass('hidden');
                        }
                    }
                });
            }, 300);
        });

        // Close suggestions on click outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.search-form').length) {
                $suggestions.addClass('hidden');
            }
        });

        // Close on Escape key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape') {
                $suggestions.addClass('hidden');
            }
        });
    });
</script>
