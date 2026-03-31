@extends('frontend.layouts.master')

@section('meta_title', 'Register')

@section('content')

<div class="fm-auth-wrapper">
    <div class="fm-auth-card">
        <!-- Image Side -->
        <div class="auth-image-side">
            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=1000&q=80" alt="Fresh Produce">
            <div class="auth-overlay">
                <h2 style="font-size:2.5rem;font-weight:900;margin-bottom:12px;line-height:1;">Join Us</h2>
                <p style="font-size:0.9rem;opacity:0.9;font-weight:600;">Create an account to join the FreshMart community and enjoy local organic produce.</p>
            </div>
        </div>

        <!-- Form Side -->
        <div class="auth-form-side">
            <div style="margin-bottom:40px;">
                <h1 style="font-size:2.2rem;font-weight:900;text-transform:uppercase;letter-spacing:-0.02em;margin-bottom:8px;">Create Account</h1>
                <p style="font-size:0.85rem;color:var(--gray-500);font-weight:700;">
                    Already a member? <a href="{{ route('login') }}" style="color:var(--green-primary);">Sign in</a>
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="fm-auth-form">
                @csrf
                
                <div class="fm-group">
                    <label class="fm-label">Full Name</label>
                    <input type="text" name="name" class="fm-input" placeholder="Your Name" value="{{ old('name') }}" required autofocus autocomplete="name">
                    @error('name')
                        <span style="color:var(--red-primary);font-size:0.75rem;font-weight:700;margin-top:4px;display:block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="fm-group">
                    <label class="fm-label">Email Address</label>
                    <input type="email" name="email" class="fm-input" placeholder="yourname@gmail.com" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span style="color:var(--red-primary);font-size:0.75rem;font-weight:700;margin-top:4px;display:block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="fm-group">
                    <label class="fm-label">Password</label>
                    <input type="password" name="password" class="fm-input" placeholder="••••••••" required autocomplete="new-password">
                    @error('password')
                        <span style="color:var(--red-primary);font-size:0.75rem;font-weight:700;margin-top:4px;display:block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="fm-group">
                    <label class="fm-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="fm-input" placeholder="••••••••" required autocomplete="new-password">
                </div>

                <button type="submit" class="fm-btn-vibrant">Register</button>

                <p style="text-align:center;font-size:0.75rem;color:var(--gray-500);margin-top:24px;font-weight:600;">
                    By creating an account, you agree to our <a href="#" style="color:var(--text-main);">Terms of Service</a> and <a href="#" style="color:var(--text-main);">Privacy Policy</a>.
                </p>
            </form>
        </div>
    </div>
</div>

@endsection
