@extends('frontend.layouts.master')

@section('meta_title', 'Your Wishlist | FreshMart')

@section('content')

<!-- Hero Section -->
<div class="fm-page-hero" style="min-height:300px;padding:32px 0;">
    <div class="hero-content">
        <span class="hero-subtitle">Personal Selection</span>
        <h1 class="hero-title" style="font-size:3.5rem;">Your Wishlist</h1>
        <div class="hero-breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="separator">/</span>
            <span class="current">Wishlist</span>
        </div>
    </div>
</div>

<div style="max-width:1280px;margin:0 auto;padding:48px 24px 80px;">
    @if($wishlistItems->count() > 0)
        <div class="wishlist-page-grid">
            @foreach($wishlistItems as $item)
                <div style="position:relative;" id="wishlist-item-{{ $item->id }}" class="group">
                    @include('frontend.components.product-card', ['product' => $item->product])
                    
                    <!-- Remove Button -->
                    <button onclick="removeFromWishlist({{ $item->id }})" 
                            style="position:absolute;top:16px;right:16px;z-index:30;width:40px;height:40px;background:white;border:1px solid var(--gray-100);color:var(--gray-300);border-radius:var(--radius-full);display:flex;align-items:center;justify-content:center;transition:var(--trans-base);cursor:pointer;box-shadow:var(--shadow-lg);"
                            onmouseover="this.style.color='var(--red-primary)';this.style.borderColor='var(--red-primary)'"
                            onmouseout="this.style.color='var(--gray-300)';this.style.borderColor='var(--gray-100)'">
                        <i class="fa fa-times" style="font-size:0.75rem;"></i>
                    </button>
                </div>
            @endforeach
        </div>
    @else
        <div style="padding:100px 0;text-align:center;background:var(--gray-50);border-radius:var(--radius-3xl);border:2px dashed var(--gray-200);">
            <div style="width:80px;height:80px;background:white;border-radius:var(--radius-full);display:flex;align-items:center;justify-content:center;margin:0 auto 32px;box-shadow:var(--shadow-xl);">
                <i class="far fa-heart" style="font-size:1.5rem;color:var(--gray-200);"></i>
            </div>
            <h3 style="font-size:1.5rem;font-weight:900;text-transform:uppercase;letter-spacing:-0.02em;margin-bottom:16px;">Your wishlist is empty</h3>
            <p style="color:var(--gray-400);font-size:0.7rem;font-weight:900;text-transform:uppercase;letter-spacing:0.15em;max-width:300px;margin:0 auto 40px;line-height:1.6;">
                Explore our fresh produce and save your favorite items here for later.
            </p>
            <a href="{{ route('products') }}" class="fm-btn-vibrant" style="display:inline-block;padding:16px 40px;">
                Start Exploring
            </a>
        </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
    function removeFromWishlist(id) {
        if(!confirm('Are you sure you want to remove this item from your Wishlist?')) return;

        $.ajax({
            url: "{{ route('wishlist.remove') }}",
            type: "POST",
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('#wishlist-item-' + id).fadeOut(500, function() {
                        $(this).remove();
                        if ($('.wishlist-page-grid > div').length === 0) {
                            location.reload(); // Show empty state
                        }
                    });
                } else {
                    toastr.error(response.message);
                }
            }
        });
    }
</script>
@endpush
