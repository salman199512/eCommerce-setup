@extends('frontend.layouts.master')

@section('meta_title', 'Login')

@section('content')
<div class="flex h-screen overflow-hidden">
    <!-- Left Side: Image -->
    <div class="hidden md:block w-1/2 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
        <div class="h-full w-full bg-black bg-opacity-40 flex items-center justify-center">
            <div class="text-white text-center px-12">
                <h2 class="text-5xl font-serif font-bold mb-4">Welcome Back</h2>
                <p class="text-xl font-light">Sign in to access your exclusive fashion feed.</p>
            </div>
        </div>
    </div>

    <!-- Right Side: Form -->
    <div class="w-full md:w-1/2 flex items-center justify-center bg-white p-8 md:p-16">
        <div class="w-full max-w-md">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-serif font-bold mb-2">Sign In</h1>
                <p class="text-gray-500">Don't have an account? <a href="{{ route('register') }}" class="text-red-600 hover:underline">Sign up</a></p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input id="email" class="block w-full border-gray-300 rounded-none border-b-2 p-3 focus:border-black focus:ring-0 focus:outline-none transition duration-300" type="email" name="email" value="{{ old('email') }}" required autofocus />
                    @error('email')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input id="password" class="block w-full border-gray-300 rounded-none border-b-2 p-3 focus:border-black focus:ring-0 focus:outline-none transition duration-300" type="password" name="password" required autocomplete="current-password" />
                    @error('password')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="block mt-4 flex justify-between items-center">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-black shadow-sm focus:border-black focus:ring-black" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div class="mt-8">
                    <button type="submit" class="w-full bg-black text-white font-bold py-4 uppercase tracking-widest hover:bg-red-600 transition duration-300">
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
