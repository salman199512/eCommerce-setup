
<!-- Top Bar -->
<div class="bg-black text-white text-xs py-2 border-b border-gray-800">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <div class="flex space-x-6 text-gray-300">
            <span class="hover:text-white cursor-pointer transition">Call: +1 123 456 7890</span>
            <span class="hover:text-white cursor-pointer transition">Email: support@fashion.com</span>
        </div>
        <div class="hidden md:flex space-x-4">
             <div class="relative group cursor-pointer">
                <span class="hover:text-white">English <i class="fa fa-angle-down ml-1"></i></span>
                <div class="absolute right-0 mt-2 w-32 bg-white text-black shadow-lg hidden group-hover:block z-50">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">English</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">French</a>
                </div>
            </div>
             <div class="relative group cursor-pointer">
                <span class="hover:text-white">USD <i class="fa fa-angle-down ml-1"></i></span>
                <div class="absolute right-0 mt-2 w-32 bg-white text-black shadow-lg hidden group-hover:block z-50">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">USD</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">EUR</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Header -->
<header class="bg-white sticky top-0 z-50 shadow-sm">
    <div class="container mx-auto px-4 py-4 md:py-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            
            <!-- Logo (Left) -->
            <div class="flex items-center justify-between w-full md:w-auto">
                <a href="{{ route('home') }}" class="text-3xl font-serif font-bold tracking-tighter text-gray-900 border-2 border-black px-2 py-1">
                    FASHION<span class="text-red-600">.</span>
                </a>
                
                <!-- Mobile Menu Button -->
                <button class="md:hidden text-gray-800 focus:outline-none" id="mobile-menu-btn">
                    <i class="fa fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Search Bar (Center) -->
            <div class="hidden md:flex flex-1 max-w-2xl mx-8 relative">
                <form action="{{ route('products') }}" method="GET" class="w-full flex">
                    <div class="relative w-full">
                         <input type="text" name="search" placeholder="Search for products..." class="w-full border border-gray-300 py-3 px-4 focus:outline-none focus:border-black transition rounded-l-md">
                         <button type="submit" class="absolute right-0 top-0 h-full px-6 bg-black text-white hover:bg-red-600 transition rounded-r-md">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Icons (Right) -->
            <div class="flex items-center space-x-6 text-gray-800">
                <a href="{{ route('my-account') }}" class="hover:text-red-600 transition flex flex-col items-center">
                    <i class="far fa-user text-xl"></i>
                    <span class="text-[10px] uppercase font-bold mt-1 hidden md:block">Account</span>
                </a>
                <a href="#" class="hover:text-red-600 transition flex flex-col items-center relative">
                    <i class="far fa-heart text-xl"></i>
                    <span class="absolute -top-1 -right-1 bg-red-600 text-white rounded-full text-[10px] w-4 h-4 flex items-center justify-center">0</span>
                    <span class="text-[10px] uppercase font-bold mt-1 hidden md:block">Wishlist</span>
                </a>
                <div class="relative group cursor-pointer hover:text-red-600 transition flex flex-col items-center">
                    <a href="{{ route('cart') }}" class="relative">
                        <i class="fas fa-shopping-bag text-xl"></i>
                        <span class="absolute -top-1 -right-1 bg-black text-white rounded-full text-[10px] w-4 h-4 flex items-center justify-center">{{ count(session('cart', [])) }}</span>
                    </a>
                    <span class="text-[10px] uppercase font-bold mt-1 hidden md:block">Cart</span>
                    
                    <!-- Mini Cart Dropdown -->
                    <div class="absolute right-0 mt-8 w-72 bg-white shadow-xl border border-gray-100 hidden group-hover:block z-50 p-4 rounded text-left text-gray-800">
                        @php $cart = session('cart', []); $total = 0; @endphp
                        @if(count($cart) > 0)
                            <div class="max-h-60 overflow-y-auto mb-4 space-y-3">
                                @foreach($cart as $id => $details)
                                    @php $total += $details['price'] * $details['quantity']; @endphp
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                                            <img src="{{ $details['image'] }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold truncate w-32">{{ $details['name'] }}</h4>
                                            <p class="text-xs text-gray-500">{{ $details['quantity'] }} x ${{ number_format($details['price'], 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="border-t pt-3 mb-3">
                                <div class="flex justify-between font-bold text-sm">
                                    <span>Total:</span>
                                    <span>${{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                            <a href="{{ route('checkout') }}" class="block w-full bg-red-600 text-white text-center py-2 text-xs font-bold uppercase hover:bg-black transition mb-2">Checkout</a>
                            <a href="{{ route('cart') }}" class="block w-full border border-gray-300 text-center py-2 text-xs font-bold uppercase hover:bg-gray-100 transition">View Cart</a>
                        @else
                            <p class="text-center text-gray-500 text-sm py-4">Your cart is empty.</p>
                            <a href="{{ route('products') }}" class="block w-full bg-black text-white text-center py-2 text-xs font-bold uppercase hover:bg-red-600 transition">Start Shopping</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Bar (Below Header) -->
    <div class="border-t border-gray-100 hidden md:block">
        <div class="container mx-auto px-4">
            <nav class="flex justify-center">
                <ul class="flex space-x-10 font-bold text-sm uppercase tracking-widest text-gray-800">
                    <li class="group">
                        <a href="{{ route('home') }}" class="block py-4 border-b-2 border-transparent hover:border-red-600 hover:text-red-600 transition">Home</a>
                    </li>
                    
                    <!-- Mega Menu: Shop -->
                     @php
                        $cats = $sharedCategories ?? collect();
                    @endphp
                    <li class="group relative">
                        <a href="{{ route('products') }}" class="block py-4 border-b-2 border-transparent hover:border-red-600 hover:text-red-600 transition flex items-center">
                            Shop <i class="fa fa-angle-down ml-1 text-xs"></i>
                        </a>
                        
                        <!-- Mega Menu Container -->
                        <div class="absolute left-0 top-full w-full bg-white shadow-xl border-t-2 border-red-600 hidden group-hover:block z-40 transition-opacity duration-300 opacity-0 group-hover:opacity-100 visible">
                            <div class="container mx-auto px-4 py-8">
                                <div class="grid grid-cols-5 gap-8">
                                    <!-- Category Columns -->
                                    @foreach($cats->take(4) as $cat)
                                    <div class="col-span-1">
                                        <h4 class="font-serif font-bold text-lg text-gray-900 mb-4 border-b pb-2 hover:text-red-600 transition">
                                            <a href="{{ route('products', ['category' => $cat->slug]) }}">{{ $cat->title }}</a>
                                        </h4>
                                        <ul class="space-y-2 text-sm text-gray-500">
                                            @foreach($cat->subCategories as $sub)
                                                <li><a href="#" class="hover:text-red-600 transition block transform hover:translate-x-1 duration-200">{{ $sub->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endforeach

                                    <!-- Promo Image -->
                                    <div class="col-span-1">
                                        <div class="relative h-full overflow-hidden group/promo">
                                            <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover transform group-hover/promo:scale-110 transition duration-700">
                                            <div class="absolute inset-0 bg-black bg-opacity-20 group-hover/promo:bg-opacity-10 transition"></div>
                                            <div class="absolute bottom-4 left-4 text-white">
                                                <span class="text-xs font-bold uppercase tracking-widest bg-red-600 px-2 py-1 mb-2 inline-block">New</span>
                                                <h3 class="font-serif text-xl">Summer Sale</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="group">
                        <a href="{{ route('products') }}" class="block py-4 border-b-2 border-transparent hover:border-red-600 hover:text-red-600 transition">Collection</a>
                    </li>
                    <li class="group">
                        <a href="{{ route('products') }}" class="block py-4 border-b-2 border-transparent hover:border-red-600 hover:text-red-600 transition">Accessories</a>
                    </li>
                    <li class="group relative">
                        <a href="#" class="block py-4 border-b-2 border-transparent hover:border-red-600 hover:text-red-600 transition flex items-center">
                            Pages <i class="fa fa-angle-down ml-1 text-xs"></i>
                        </a>
                        <div class="absolute left-0 mt-0 w-48 bg-white shadow-lg border-t-2 border-red-600 hidden group-hover:block z-50">
                            <a href="{{ route('about-us') }}" class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-red-600 transition border-b border-gray-100">About Us</a>
                            <a href="{{ route('contact-us') }}" class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-red-600 transition border-b border-gray-100">Contact Us</a>
                            <a href="{{ route('login') }}" class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-red-600 transition border-b border-gray-100">Login</a>
                            <a href="{{ route('register') }}" class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-red-600 transition">Register</a>
                        </div>
                    </li>
                     <li class="group">
                        <a href="{{ route('contact-us') }}" class="block py-4 border-b-2 border-transparent hover:border-red-600 hover:text-red-600 transition">Contact</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<!-- Mobile Menu Overlay -->
<div id="mobile-menu" class="hidden fixed inset-0 z-[60]">
    <div class="absolute inset-0 bg-black opacity-50" id="close-mobile-menu-overlay"></div>
    <div class="absolute left-0 top-0 w-4/5 max-w-sm h-full bg-white shadow-2xl overflow-y-auto transform transition-transform duration-300">
        <div class="p-4 flex justify-between items-center border-b bg-gray-50">
             <span class="font-serif font-bold text-xl tracking-tight">FASHION<span class="text-red-600">.</span></span>
             <button id="close-mobile-menu" class="text-2xl text-gray-600 hover:text-red-600"><i class="fa fa-times"></i></button>
        </div>
        
        <div class="p-4">
            <form action="{{ route('products') }}" method="GET" class="relative mb-6">
                <input type="text" name="search" placeholder="Search..." class="w-full bg-gray-100 border-none py-3 px-4 rounded focus:ring-1 focus:ring-black">
                <button class="absolute right-3 top-3 text-gray-500"><i class="fa fa-search"></i></button>
            </form>

            <nav class="space-y-1">
                <a href="{{ route('home') }}" class="block py-3 px-2 font-bold uppercase text-sm border-b hover:text-red-600">Home</a>
                
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center py-3 px-2 font-bold uppercase text-sm border-b hover:text-red-600">
                        Shop <i class="fa fa-angle-down transition-transform" :class="{'rotate-180': open}"></i>
                    </button>
                    <div x-show="open" class="pl-4 bg-gray-50 py-2">
                         @foreach($cats as $cat)
                         <div x-data="{ subOpen: false }">
                             <button @click="subOpen = !subOpen" class="w-full flex justify-between items-center py-2 px-2 text-sm font-medium hover:text-red-600">
                                {{ $cat->title }} <i class="fa fa-plus text-xs text-gray-400" :class="{'fa-minus': subOpen, 'fa-plus': !subOpen}"></i>
                             </button>
                             <div x-show="subOpen" class="pl-4 border-l-2 border-gray-200 ml-2">
                                  @foreach($cat->subCategories as $sub)
                                    <a href="#" class="block py-1 text-xs text-gray-500 hover:text-red-600">{{ $sub->title }}</a>
                                  @endforeach
                             </div>
                         </div>
                         @endforeach
                    </div>
                </div>

                <a href="{{ route('products') }}" class="block py-3 px-2 font-bold uppercase text-sm border-b hover:text-red-600">Collection</a>
                <a href="{{ route('products') }}" class="block py-3 px-2 font-bold uppercase text-sm border-b hover:text-red-600">Accessories</a>
                <a href="{{ route('about-us') }}" class="block py-3 px-2 font-bold uppercase text-sm border-b hover:text-red-600">About</a>
                <a href="{{ route('contact-us') }}" class="block py-3 px-2 font-bold uppercase text-sm border-b hover:text-red-600">Contact</a>
            </nav>

            <div class="mt-8 border-t pt-6">
                <a href="{{ route('login') }}" class="flex items-center gap-3 py-2 text-gray-600 hover:text-black">
                    <i class="far fa-user text-lg"></i> Sign In / Register
                </a>
                <a href="#" class="flex items-center gap-3 py-2 text-gray-600 hover:text-black">
                    <i class="far fa-heart text-lg"></i> Wishlist
                </a>
            </div>
        </div>
    </div>
</div>

<script>
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
</script>
