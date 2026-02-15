
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
<header class="bg-white sticky top-0 z-50 border-b border-gray-100 transition-all duration-300" id="main-header">
    <div class="container mx-auto px-4 py-3 md:py-4">
        <div class="flex items-center justify-between gap-4">
            
            <!-- Logo (Left) -->
            <div class="flex items-center shrink-0">
                <a href="{{ route('home') }}" class="group flex items-center">
                    <div class="relative">
                        <span class="text-2xl md:text-3xl font-bold tracking-tighter text-black uppercase">
                            Fashion<span class="text-red-600">.</span>
                        </span>
                        <div class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-600 transition-all duration-300 group-hover:w-full"></div>
                    </div>
                </a>
            </div>

            <!-- Search Bar (Center) -->
            <div class="hidden lg:flex flex-1 max-w-xl mx-8">
                <form action="{{ route('products') }}" method="GET" class="w-full relative group">
                    <input type="text" name="search" placeholder="Discover the latest collection..." 
                           class="w-full bg-gray-50 border-none py-2.5 px-5 pr-12 focus:ring-2 focus:ring-black/5 transition-all rounded-full text-sm">
                    <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 flex items-center justify-center text-gray-400 hover:text-black transition-colors">
                        <i class="fa fa-search text-sm"></i>
                    </button>
                    <div class="absolute bottom-0 left-5 right-5 h-[1px] bg-black scale-x-0 group-focus-within:scale-x-100 transition-transform duration-300"></div>
                </form>
            </div>

            <!-- Icons & Actions (Right) -->
            <div class="flex items-center space-x-5 md:space-x-7 text-black">
                <!-- Search for Mobile/Tablet -->
                <button class="lg:hidden hover:text-red-600 transition-colors">
                    <i class="fa fa-search text-lg"></i>
                </button>

                <a href="{{ route('my-account') }}" class="group relative hover:text-red-600 transition-colors flex flex-col items-center">
                    <i class="far fa-user text-xl"></i>
                    <span class="text-[8px] uppercase font-bold tracking-premium mt-1.5 hidden md:block group-hover:opacity-100 opacity-60">Identity</span>
                </a>
                
                <a href="#" class="group relative hover:text-red-600 transition-colors flex flex-col items-center">
                    <i class="far fa-heart text-xl"></i>
                    <span class="absolute -top-1 -right-2 bg-red-600 text-white rounded-full text-[8px] w-3.5 h-3.5 flex items-center justify-center font-bold">0</span>
                    <span class="text-[8px] uppercase font-bold tracking-premium mt-1.5 hidden md:block group-hover:opacity-100 opacity-60">Favorites</span>
                </a>

                <div class="relative group cursor-pointer flex flex-col items-center">
                    <a href="{{ route('cart') }}" class="relative hover:text-red-600 transition-colors">
                        <i class="fas fa-shopping-bag text-xl"></i>
                        <span class="absolute -top-1 -right-2 bg-black text-white rounded-full text-[8px] w-3.5 h-3.5 flex items-center justify-center font-bold">{{ count(session('cart', [])) }}</span>
                    </a>
                    <span class="text-[8px] uppercase font-bold tracking-premium mt-1.5 hidden md:block group-hover:opacity-100 opacity-60">Bag</span>
                    
                    <!-- Mini Cart Dropdown -->
                    <div class="absolute right-0 top-full mt-2 w-80 bg-white shadow-2xl border border-gray-100 hidden group-hover:block z-50 p-5 rounded-xl text-left text-gray-800 animate-fadeInScale">
                        <h4 class="text-sm font-black uppercase tracking-widest mb-4 border-b pb-2">Shopping Bag</h4>
                        @php $cart = session('cart', []); $total = 0; @endphp
                        @if(count($cart) > 0)
                            <div class="max-h-72 overflow-y-auto mb-5 space-y-4 pr-2 custom-scrollbar">
                                @foreach($cart as $id => $details)
                                    @php $total += $details['price'] * $details['quantity']; @endphp
                                    <div class="flex items-center gap-4 group/item">
                                        <div class="w-16 h-20 bg-gray-50 rounded-lg overflow-hidden flex-shrink-0">
                                            <img src="{{ $details['image'] }}" class="w-full h-full object-cover group-hover/item:scale-110 transition duration-500">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-xs font-bold truncate text-gray-900">{{ $details['name'] }}</h4>
                                            <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-tighter">{{ $details['quantity'] }} × ${{ number_format($details['price'], 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="border-t border-dashed pt-4 mb-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Subtotal</span>
                                    <span class="text-lg font-black">${{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <a href="{{ route('cart') }}" class="block w-full border border-black text-black text-center py-3 text-[10px] font-black uppercase tracking-widest hover:bg-black hover:text-white transition duration-300 rounded-lg">Update</a>
                                <a href="{{ route('checkout') }}" class="block w-full bg-red-600 text-white text-center py-3 text-[10px] font-black uppercase tracking-widest hover:bg-black transition duration-300 rounded-lg">Pay Now</a>
                            </div>
                        @else
                            <div class="py-8 text-center">
                                <i class="fas fa-shopping-bag text-3xl text-gray-100 mb-3 block"></i>
                                <p class="text-xs text-gray-400 uppercase tracking-widest">Your bag is empty</p>
                                <a href="{{ route('products') }}" class="inline-block mt-4 text-[10px] font-black uppercase tracking-widest text-red-600 hover:text-black transition">Explore Shop</a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Mobile Menu Toggle -->
                <button class="md:hidden hover:text-red-600 transition-colors" id="mobile-menu-btn">
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
                        <a href="{{ route('home') }}" class="block py-4 hover:text-red-600 transition-colors">Home</a>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-red-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </li>
                    
                    <!-- Mega Menu: Shop -->
                    @php $cats = $sharedCategories ?? collect(); @endphp
                    <li class="relative group">
                        <a href="{{ route('products') }}" class="block py-4 hover:text-red-600 transition-colors flex items-center gap-1">
                            Shop <i class="fa fa-angle-down text-[8px] transition-transform duration-300 group-hover:rotate-180"></i>
                        </a>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-red-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                        
                        <!-- Mega Menu Container -->
                        <div class="absolute left-1/2 -translate-x-1/2 top-full w-screen max-w-5xl bg-white shadow-2xl hidden group-hover:block transition-all duration-300 opacity-0 group-hover:opacity-100 visible z-40 border-t border-gray-50 animate-fadeInUpSmall">
                            <div class="grid grid-cols-12">
                                <div class="col-span-9 p-10">
                                    <div class="grid grid-cols-4 gap-10">
                                        @foreach($cats->take(4) as $cat)
                                        <div>
                                            <h4 class="font-black text-sm text-black mb-5 tracking-tight border-b border-gray-100 pb-2">
                                                <a href="{{ route('products', ['category' => $cat->slug]) }}" class="hover:text-red-600 transition">{{ $cat->title }}</a>
                                            </h4>
                                            <ul class="space-y-3 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                                                @foreach($cat->subCategories as $sub)
                                                    <li><a href="#" class="hover:text-black transition-all hover:translate-x-1 inline-block">{{ $sub->title }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-span-3 bg-gray-50 p-6 relative overflow-hidden group/promo">
                                    <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" 
                                         class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover/promo:scale-110 transition duration-1000">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                                    <div class="relative h-full flex flex-col justify-end text-white">
                                        <span class="text-[9px] font-black uppercase tracking-widest bg-red-600 w-fit px-2 py-1 mb-2">Editor's Pick</span>
                                        <h3 class="text-2xl font-black leading-tight">Spring<br>Collection</h3>
                                        <a href="{{ route('products') }}" class="text-[10px] font-black uppercase tracking-widest mt-4 border-b border-white w-fit hover:text-red-400 hover:border-red-400 transition">View Story</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="relative group">
                        <a href="{{ route('products') }}" class="block py-4 hover:text-red-600 transition-colors">Collections</a>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-red-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </li>
                    <li class="relative group">
                        <a href="{{ route('about-us') }}" class="block py-4 hover:text-red-600 transition-colors">House</a>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-red-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </li>
                    <li class="relative group">
                        <a href="{{ route('contact-us') }}" class="block py-4 hover:text-red-600 transition-colors">Support</a>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-red-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
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
             <span class="font-black text-xl tracking-tight uppercase">FASHION<span class="text-red-600">.</span></span>
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
