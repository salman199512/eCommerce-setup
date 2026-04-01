@extends('frontend.layouts.master')

@section('meta_title', 'Login')

@section('content')

<div class="fm-auth-wrapper">
    <div class="fm-auth-card animate-fade-up">
        <!-- Image Side -->
        <div class="auth-image-side">
            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=1000&q=80" alt="Fresh Produce">
            <div class="auth-overlay">
                <div class="mb-24">
                    <span class="badge badge-vibrant mb-12">Welcome Early</span>
                    <h2 style="font-size:2.8rem;font-weight:900;margin-bottom:16px;line-height:1.1;">Welcome<br>Back!</h2>
                    <p style="font-size:0.95rem;opacity:0.85;font-weight:500;max-width:320px;">Access your personalized dashboard and exclusive organic collections.</p>
                </div>
                <div class="flex items-center gap-12" style="font-size:0.75rem;font-weight:700;opacity:0.6;">
                    <i class="fas fa-shield-check"></i> Secure SSL Encryption
                </div>
            </div>
        </div>

        <!-- Form Side -->
        <div class="auth-form-side">
            <div style="margin-bottom:48px;">
                <h1 style="font-size:2.4rem;font-weight:900;letter-spacing:-0.03em;margin-bottom:10px;color:var(--gray-900);">Sign In</h1>
                <p style="font-size:0.88rem;color:var(--gray-500);font-weight:600;">
                    New to ShopZone? <a href="{{ route('register') }}" style="color:var(--primary);font-weight:800;border-bottom:2px solid var(--primary-light);">Create Account</a>
                </p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="fm-auth-form">
                @csrf
                
                <div class="fm-group">
                    <label class="fm-label">Email Address</label>
                    <div style="position:relative;">
                        <i class="far fa-envelope" style="position:absolute;left:16px;top:50%;transform:translateY(-50%);color:var(--gray-400);font-size:0.9rem;"></i>
                        <input type="email" name="email" class="fm-input @error('email') error @enderror" 
                               style="padding-left:46px;"
                               placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                    </div>
                    @error('email')
                        <span style="color:var(--danger);font-size:0.72rem;font-weight:700;margin-top:6px;display:block;"><i class="fas fa-circle-exclamation"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="fm-group">
                    <label class="fm-label">Password</label>
                    <div style="position:relative;">
                        <i class="far fa-lock" style="position:absolute;left:16px;top:50%;transform:translateY(-50%);color:var(--gray-400);font-size:0.9rem;"></i>
                        <input type="password" name="password" class="fm-input" 
                               style="padding-left:46px;"
                               placeholder="••••••••" required>
                    </div>
                </div>

                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:36px;">
                    <label class="flex items-center gap-8 cursor-pointer" style="font-size:0.82rem;font-weight:700;color:var(--gray-600);">
                        <input type="checkbox" name="remember" class="fm-checkbox">
                        Remember me
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" style="font-size:0.82rem;font-weight:700;color:var(--gray-400);transition:color .2s;">Forgot Password?</a>
                    @endif
                </div>

                <button type="submit" class="fm-btn-vibrant w-full">
                    <span>Access Account</span>
                    <i class="fas fa-arrow-right-to-bracket"></i>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
