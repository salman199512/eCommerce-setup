@extends('frontend.account.layout')

@section('page-title', 'Account Details')

@section('account-content')

<div class="bg-white border border-gray-100 rounded-3xl p-8 md:p-10">
    <h2 class="text-[11px] font-black uppercase tracking-widest text-gray-400 mb-8 pb-4 border-b border-gray-100">Personal Information</h2>
    
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3">
            <i class="fas fa-check-circle text-xl"></i>
            <span class="font-black text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('my-account.update') }}">
        @csrf
        @method('PUT')
        
        <div class="space-y-8">
            <!-- Name Field -->
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3">Full Name</label>
                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required 
                       class="w-full px-6 py-4 border-2 border-gray-100 rounded-2xl focus:ring-2 focus:ring-black focus:border-transparent transition-all text-sm font-bold">
                @error('name')
                    <p class="text-red-600 text-xs font-black mt-2 uppercase tracking-widest">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3">Email Address</label>
                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required 
                       class="w-full px-6 py-4 border-2 border-gray-100 rounded-2xl focus:ring-2 focus:ring-black focus:border-transparent transition-all text-sm font-bold">
                @error('email')
                    <p class="text-red-600 text-xs font-black mt-2 uppercase tracking-widest">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Section -->
            <div class="border-t-2 border-gray-100 pt-8">
                <h3 class="text-[11px] font-black uppercase tracking-widest text-gray-400 mb-6">Change Password</h3>
                <p class="text-xs text-gray-500 mb-6 font-medium">Leave blank to keep your current password</p>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3">New Password</label>
                        <input type="password" name="password" 
                               class="w-full px-6 py-4 border-2 border-gray-100 rounded-2xl focus:ring-2 focus:ring-black focus:border-transparent transition-all text-sm font-bold">
                        @error('password')
                            <p class="text-red-600 text-xs font-black mt-2 uppercase tracking-widest">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3">Confirm New Password</label>
                        <input type="password" name="password_confirmation" 
                               class="w-full px-6 py-4 border-2 border-gray-100 rounded-2xl focus:ring-2 focus:ring-black focus:border-transparent transition-all text-sm font-bold">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-6 border-t-2 border-gray-100">
                <button type="submit" class="px-10 py-4 bg-black text-white rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-red-600 transition-all duration-500 shadow-xl shadow-black/10 hover:shadow-2xl hover:shadow-black/20">
                    Update Profile
                </button>
            </div>
        </div>
    </form>
</div>

@endsection
