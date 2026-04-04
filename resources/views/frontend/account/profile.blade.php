@extends('frontend.account.layout')

@section('page-title', 'Account Details')

@section('account-content')

<div class="bg-white border-light rounded-xl p-24" style="padding:40px;">
    <h2 style="font-size:0.7rem;font-weight:900;text-transform:uppercase;letter-spacing:0.15em;color:var(--gray-400);margin-bottom:32px;padding-bottom:16px;border-bottom:1px solid var(--gray-100);">Personal Information</h2>

    @if(session('success'))
        <div style="background:var(--primary-soft);border:1px solid var(--primary-light);color:var(--primary);padding:16px 24px;border-radius:var(--radius-2xl);margin-bottom:32px;display:flex;align-items:center;gap:12px;">
            <i class="fas fa-check-circle" style="font-size:1.25rem;"></i>
            <span style="font-weight:900;font-size:0.85rem;">{{ session('success') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('my-account.update') }}">
        @csrf
        @method('PUT')

        <div class="flex flex-col gap-32">
            <!-- Name & Email -->
            <div class="grid-2 account-stats-grid gap-32">
                <div>
                    <label style="display:block;font-size:0.65rem;font-weight:900;text-transform:uppercase;letter-spacing:0.15em;color:var(--gray-400);margin-bottom:12px;">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required class="fm-input" style="font-weight:700;">
                    @error('name')
                        <p style="color:var(--red-primary);font-size:0.75rem;font-weight:900;margin-top:8px;text-transform:uppercase;letter-spacing:0.1em;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label style="display:block;font-size:0.65rem;font-weight:900;text-transform:uppercase;letter-spacing:0.15em;color:var(--gray-400);margin-bottom:12px;">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required class="fm-input" style="font-weight:700;">
                    @error('email')
                        <p style="color:var(--red-primary);font-size:0.75rem;font-weight:900;margin-top:8px;text-transform:uppercase;letter-spacing:0.1em;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Password Section -->
            <div style="border-top:1px solid var(--gray-100);padding-top:40px;">
                <h3 style="font-size:0.7rem;font-weight:900;text-transform:uppercase;letter-spacing:0.15em;color:var(--gray-400);margin-bottom:8px;">Security Settings</h3>
                <p style="font-size:0.75rem;color:var(--gray-500);margin-bottom:32px;font-weight:600;">Update your password regularly for better security.</p>

                <div class="grid-2 gap-24">
                    <div>
                        <label style="display:block;font-size:0.65rem;font-weight:900;text-transform:uppercase;letter-spacing:0.15em;color:var(--gray-400);margin-bottom:12px;">New Password</label>
                        <input type="password" name="password" class="fm-input" placeholder="••••••••">
                        @error('password')
                            <p style="color:var(--red-primary);font-size:0.75rem;font-weight:900;margin-top:8px;text-transform:uppercase;letter-spacing:0.1em;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label style="display:block;font-size:0.65rem;font-weight:900;text-transform:uppercase;letter-spacing:0.15em;color:var(--gray-400);margin-bottom:12px;">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="fm-input" placeholder="••••••••">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-32 border-t border-gray-100" style="padding-top:32px;border-top:1px solid var(--gray-100);">
                <button type="submit" class="fm-btn-vibrant" style="padding:18px 48px;font-size:0.75rem;">
                    Update Profile
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
