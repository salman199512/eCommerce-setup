@extends('frontend.layouts.master')

@section('meta_title', 'My Account — FreshMart')

@section('content')

<!-- Page Hero -->
<div class="fm-page-hero" style="padding:40px 0;">
    <div class="hero-content">
        <span class="hero-subtitle">My Account</span>
        <h1 class="hero-title" style="font-size:2.6rem;">@yield('page-title', 'My Account')</h1>
        <div class="hero-breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="separator">/</span>
            <span class="current">@yield('page-title', 'Account')</span>
        </div>
    </div>
</div>

<div class="account-layout-wrap">

    <!-- ── Account Sidebar ── -->
    <aside class="account-sidebar-col">
        <div class="account-sidebar-card">
            <!-- User Header -->
            <div class="account-sidebar-head">
                <div class="account-avatar-circle">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="account-sidebar-label">Welcome back</div>
                <div class="account-sidebar-name">{{ Auth::user()->name }}</div>
                <div style="font-size:0.68rem;color:rgba(255,255,255,0.4);margin-top:4px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ Auth::user()->email }}</div>
            </div>

            <!-- Nav Links -->
            <nav class="account-sidebar-nav">
                <a href="{{ route('my-account') }}"
                   class="account-sidebar-link {{ request()->routeIs('my-account') && !request()->routeIs('my-account.*') ? 'active' : '' }}">
                    <i class="fas fa-gauge-high"></i> Dashboard
                </a>
                <a href="{{ route('my-orders') }}"
                   class="account-sidebar-link {{ request()->routeIs('my-orders*') ? 'active' : '' }}">
                    <i class="fas fa-box-open"></i> My Orders
                </a>
                <a href="{{ route('wishlist') }}"
                   class="account-sidebar-link {{ request()->routeIs('wishlist') ? 'active' : '' }}">
                    <i class="fas fa-heart"></i> Wishlist
                </a>
                <a href="{{ route('my-account.profile') }}"
                   class="account-sidebar-link {{ request()->routeIs('my-account-profile') ? 'active' : '' }}">
                    <i class="fas fa-user-pen"></i> Account Details
                </a>

                <hr class="account-sidebar-divider">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="account-sidebar-signout">
                        <i class="fas fa-right-from-bracket" style="width:18px;text-align:center;"></i> Sign Out
                    </button>
                </form>
            </nav>
        </div>
    </aside>

    <!-- ── Content Area ── -->
    <div class="account-content-col">
        @yield('account-content')
    </div>

</div>

@endsection
