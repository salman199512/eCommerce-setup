@extends('frontend.layouts.master')

@section('meta_title', 'Login')

@section('content')

<div class="fm-auth-wrapper">
    <div class="fm-auth-card">
        <!-- Image Side -->
        <div class="auth-image-side">
            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=1000&q=80" alt="Fresh Produce">
            <div class="auth-overlay">
                <h2 style="font-size:2.5rem;font-weight:900;margin-bottom:12px;line-height:1;">Welcome Back</h2>
                <p style="font-size:0.9rem;opacity:0.9;font-weight:600;">Sign in to FreshMart for the freshest produce and exclusive organic deals.</p>
            </div>
        </div>

        <!-- Form Side -->
        <div class="auth-form-side">
            <div style="margin-bottom:40px;">
                <h1 style="font-size:2.2rem;font-weight:900;text-transform:uppercase;letter-spacing:-0.02em;margin-bottom:8px;">Sign In</h1>
                <p style="font-size:0.85rem;color:var(--gray-500);font-weight:700;">
                    Don't have an account? <a href="{{ route('register') }}" style="color:var(--green-primary);">Sign up</a>
                </p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="fm-auth-form">
                @csrf
                
                <div class="fm-group">
                    <label class="fm-label">Email Address</label>
                    <input type="email" name="email" class="fm-input @error('email') border-red-500 @enderror" 
                           placeholder="yourname@gmail.com" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span style="color:var(--red-primary);font-size:0.75rem;font-weight:700;margin-top:4px;display:block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="fm-group">
                    <label class="fm-label">Password</label>
                    <input type="password" name="password" class="fm-input" placeholder="••••••••" required>
                </div>

                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;">
                    <label style="display:flex;align-items:center;gap:8px;font-size:0.8rem;font-weight:700;cursor:pointer;">
                        <input type="checkbox" name="remember" style="width:16px;height:16px;accent-color:var(--green-primary);">
                        Remember me
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" style="font-size:0.8rem;font-weight:700;color:var(--gray-400);text-decoration:none;">Forgot your password?</a>
                    @endif
                </div>

                <button type="submit" class="fm-btn-vibrant">Log in</button>
            </form>
        </div>
    </div>
</div>
@endsection
