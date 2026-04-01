@extends('frontend.layouts.master')

@section('meta_title', 'Register')

@section('content')

<div class="fm-auth-wrapper">
    <div class="fm-auth-card animate-fade-up">
        <!-- Image Side -->
        <div class="auth-image-side">
            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=1000&q=80" alt="Join Us">
            <div class="auth-overlay">
                <div class="mb-24">
                    <span class="badge badge-vibrant mb-12">New Member</span>
                    <h2 style="font-size:2.8rem;font-weight:900;margin-bottom:16px;line-height:1.1;">Start Your<br>Journey</h2>
                    <p style="font-size:0.95rem;opacity:0.85;font-weight:500;max-width:320px;">Join thousands of happy customers enjoying the freshest produce delivered daily.</p>
                </div>
                <div class="flex items-center gap-12" style="font-size:0.75rem;font-weight:700;opacity:0.6;">
                    <i class="fas fa-gift"></i> Get 10% Off Your First Order
                </div>
            </div>
        </div>

        <!-- Form Side -->
        <div class="auth-form-side" style="padding:48px 60px;">
            <div style="margin-bottom:36px;">
                <h1 style="font-size:2.4rem;font-weight:900;letter-spacing:-0.03em;margin-bottom:8px;color:var(--gray-900);">Join Us</h1>
                <p style="font-size:0.88rem;color:var(--gray-500);font-weight:600;">
                    Already a member? <a href="{{ route('login') }}" style="color:var(--primary);font-weight:800;border-bottom:2px solid var(--primary-light);">Sign In</a>
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="fm-auth-form">
                @csrf
                
                <div class="fm-group">
                    <label class="fm-label">Full Name</label>
                    <div style="position:relative;">
                        <i class="far fa-user" style="position:absolute;left:16px;top:50%;transform:translateY(-50%);color:var(--gray-400);font-size:0.9rem;"></i>
                        <input type="text" name="name" class="fm-input @error('name') error @enderror" 
                               style="padding-left:46px;"
                               placeholder="John Doe" value="{{ old('name') }}" required autofocus autocomplete="name">
                    </div>
                    @error('name')
                        <span style="color:var(--danger);font-size:0.72rem;font-weight:700;margin-top:6px;display:block;"><i class="fas fa-circle-exclamation"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="fm-group">
                    <label class="fm-label">Email Address</label>
                    <div style="position:relative;">
                        <i class="far fa-envelope" style="position:absolute;left:16px;top:50%;transform:translateY(-50%);color:var(--gray-400);font-size:0.9rem;"></i>
                        <input type="email" name="email" class="fm-input @error('email') error @enderror" 
                               style="padding-left:46px;"
                               placeholder="name@example.com" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                    @error('email')
                        <span style="color:var(--danger);font-size:0.72rem;font-weight:700;margin-top:6px;display:block;"><i class="fas fa-circle-exclamation"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="grid-2 gap-16 mb-24">
                    <div class="fm-group">
                        <label class="fm-label">Password</label>
                        <input type="password" name="password" class="fm-input @error('password') error @enderror" 
                               placeholder="••••••••" required autocomplete="new-password">
                        @error('password')
                            <span style="color:var(--danger);font-size:0.72rem;font-weight:700;margin-top:6px;display:block;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="fm-group">
                        <label class="fm-label">Confirm</label>
                        <input type="password" name="password_confirmation" class="fm-input" 
                               placeholder="••••••••" required autocomplete="new-password">
                    </div>
                </div>

                <button type="submit" class="fm-btn-vibrant w-full">
                    <span>Create Free Account</span>
                    <i class="fas fa-user-plus"></i>
                </button>

                <p style="text-align:center;font-size:0.78rem;color:var(--gray-400);margin-top:28px;font-weight:600;line-height:1.5;">
                    By joining, you agree to our <a href="#" style="color:var(--gray-600);text-decoration:underline;">Terms</a> and <a href="#" style="color:var(--gray-600);text-decoration:underline;">Privacy Policy</a>.
                </p>
            </form>
        </div>
    </div>
</div>

@endsection
