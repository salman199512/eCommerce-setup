@extends('frontend.layouts.master')

@section('meta_title', 'Register')

@section('content')
<div class="flex h-screen overflow-hidden">
    <!-- Left Side: Image -->
    <div class="hidden md:block w-1/2 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1543076447-215ad9ba6923?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
        <div class="h-full w-full bg-black bg-opacity-40 flex items-center justify-center">
            <div class="text-white text-center px-12">
                <h2 class="text-5xl font-serif font-bold mb-4">Join Us</h2>
                <p class="text-xl font-light">Create an account to unlock exclusive benefits and early access.</p>
            </div>
        </div>
    </div>

    <!-- Right Side: Form -->
    <div class="w-full md:w-1/2 flex items-center justify-center bg-white p-8 md:p-16">
        <div class="w-full max-w-md">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-serif font-bold mb-2">Create Account</h1>
                <p class="text-gray-500">Already a member? <a href="{{ route('login') }}" class="text-red-600 hover:underline">Sign in</a></p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input id="name" class="block w-full border-gray-300 rounded-none border-b-2 p-3 focus:border-black focus:ring-0 focus:outline-none transition duration-300" type="text" name="name" value="{{ old('name') }}" required autofocus />
                    @error('name')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input id="email" class="block w-full border-gray-300 rounded-none border-b-2 p-3 focus:border-black focus:ring-0 focus:outline-none transition duration-300" type="email" name="email" value="{{ old('email') }}" required />
                    @error('email')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input id="password" class="block w-full border-gray-300 rounded-none border-b-2 p-3 focus:border-black focus:ring-0 focus:outline-none transition duration-300" type="password" name="password" required autocomplete="new-password" />
                    @error('password')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <input id="password_confirmation" class="block w-full border-gray-300 rounded-none border-b-2 p-3 focus:border-black focus:ring-0 focus:outline-none transition duration-300" type="password" name="password_confirmation" required />
                    @error('password_confirmation')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8">
                    <button type="submit" class="w-full bg-black text-white font-bold py-4 uppercase tracking-widest hover:bg-red-600 transition duration-300">
                        Register
                    </button>
                    <p class="text-xs text-center text-gray-400 mt-4">By creating an account, you agree to our <a href="#" class="underline">Terms of Service</a> and <a href="#" class="underline">Privacy Policy</a>.</p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
