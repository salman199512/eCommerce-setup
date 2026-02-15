@extends('frontend.layouts.master')

@section('meta_title', 'My Account')

@section('content')

<!-- Page Header -->
<div class="bg-white pt-24 pb-12 border-b border-gray-100">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <span class="text-red-600 text-[12px] font-black uppercase tracking-[0.3em] mb-6 block">Account</span>
            <h1 class="text-5xl md:text-6xl font-black mb-8 leading-[0.9] tracking-[-0.04em] text-black uppercase">@yield('page-title', 'My Account')</h1>
            <div class="flex items-center gap-3 text-[10px] font-black uppercase tracking-widest text-gray-400">
                <a href="{{ route('home') }}" class="hover:text-black transition">Home</a>
                <span class="opacity-30">/</span>
                <span class="text-black">Account</span>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-16 md:py-24">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden shadow-sm sticky top-32">
                    <div class="p-8 bg-gray-50 border-b border-gray-100">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-black to-gray-800 rounded-full flex items-center justify-center text-white shadow-xl">
                                 <span class="text-2xl font-black">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
                            </div>
                            <div>
                                <p class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400 mb-1">Hello,</p>
                                <h3 class="text-base font-black text-black uppercase tracking-wide truncate">{{ Auth::user()->name }}</h3>
                            </div>
                        </div>
                    </div>
                    <nav class="p-4 space-y-2">
                        <a href="{{ route('my-account') }}" class="block w-full text-left px-6 py-4 rounded-2xl transition-all duration-500 flex items-center gap-4 text-sm font-black uppercase tracking-widest {{ request()->routeIs('my-account') ? 'bg-black text-white shadow-xl shadow-black/10' : 'text-gray-600 hover:bg-gray-50' }} group">
                            <i class="fas fa-th-large w-5 text-center group-hover:scale-110 transition-transform"></i> Dashboard
                        </a>
                        <a href="{{ route('my-orders') }}" class="block w-full text-left px-6 py-4 rounded-2xl transition-all duration-500 flex items-center gap-4 text-sm font-black uppercase tracking-widest {{ request()->routeIs('my-orders*') ? 'bg-black text-white shadow-xl shadow-black/10' : 'text-gray-600 hover:bg-gray-50' }} group">
                            <i class="fas fa-shopping-bag w-5 text-center group-hover:scale-110 transition-transform"></i> My Orders
                        </a>
                        <a href="{{ route('wishlist') }}" class="block w-full text-left px-6 py-4 rounded-2xl transition-all duration-500 flex items-center gap-4 text-sm font-black uppercase tracking-widest {{ request()->routeIs('wishlist') ? 'bg-black text-white shadow-xl shadow-black/10' : 'text-gray-600 hover:bg-gray-50' }} group">
                            <i class="fas fa-heart w-5 text-center group-hover:scale-110 transition-transform"></i> Wishlist
                        </a>
                        <a href="#" class="block w-full text-left px-6 py-4 rounded-2xl transition-all duration-500 flex items-center gap-4 text-sm font-black uppercase tracking-widest {{ request()->routeIs('my-account.profile') ? 'bg-black text-white shadow-xl shadow-black/10' : 'text-gray-600 hover:bg-gray-50' }} group">
                            <i class="fas fa-user w-5 text-center group-hover:scale-110 transition-transform"></i> Account Details
                        </a>
                        <div class="pt-4 border-t border-gray-100 mt-4">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-6 py-4 rounded-2xl transition-all duration-500 flex items-center gap-4 text-sm font-black uppercase tracking-widest text-red-600 hover:bg-red-50 group">
                                    <i class="fas fa-sign-out-alt w-5 text-center group-hover:scale-110 transition-transform"></i> Sign Out
                                </button>
                            </form>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- Content Area -->
            <div class="lg:col-span-3">
                @yield('account-content')
            </div>
        </div>
    </div>
</div>

@endsection
