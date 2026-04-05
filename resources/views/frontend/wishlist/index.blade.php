@extends('frontend.account.layout')

@section('page-title', 'Your Wishlist')

@section('account-content')

@if($wishlistItems->count() > 0)
    <div class="wishlist-page-grid" style="display:grid;grid-template-columns:repeat(auto-fill, minmax(280px, 1fr));gap:24px;">
        @foreach($wishlistItems as $item)
            <div style="position:relative;" id="wishlist-item-{{ $item->id }}" class="group">
                @include('frontend.components.product-card', ['product' => $item->product])
                
                <!-- Remove Button -->
                <button onclick="removeFromWishlist({{ $item->id }})" 
                        class="wishlist-remove-btn"
                        style="position:absolute;top:16px;right:16px;z-index:30;width:40px;height:40px;background:white;border:1px solid var(--gray-100);color:var(--gray-300);border-radius:var(--radius-full);display:flex;align-items:center;justify-content:center;transition:var(--trans-base);cursor:pointer;box-shadow:var(--shadow-lg);"
                        onmouseover="this.style.color='var(--red-primary)';this.style.borderColor='var(--red-primary)'"
                        onmouseout="this.style.color='var(--gray-300)';this.style.borderColor='var(--gray-100)'">
                    <i class="fa fa-times" style="font-size:0.75rem;"></i>
                </button>
            </div>
        @endforeach
    </div>
@else
    <div style="padding:100px 40px;text-align:center;background:white;border:1px solid var(--border-light);border-radius:var(--radius-2xl);box-shadow:var(--shadow-sm);">
        <div style="width:96px;height:96px;background:var(--gray-50);border-radius:var(--radius-full);display:flex;align-items:center;justify-content:center;margin:0 auto 32px;box-shadow:inset 0 2px 4px rgba(0,0,0,0.05);">
            <i class="far fa-heart" style="font-size:2.5rem;color:var(--gray-200);"></i>
        </div>
        <h3 style="font-size:2rem;font-weight:900;text-transform:uppercase;letter-spacing:-0.02em;margin-bottom:16px;color:var(--gray-900);">Your wishlist is empty</h3>
        <p style="color:var(--gray-500);font-size:0.9rem;font-weight:500;max-width:400px;margin:0 auto 40px;line-height:1.6;">
            Explore our fresh produce and save your favorite items here for later.
        </p>
        <a href="{{ route('products') }}" class="fm-btn-vibrant" style="display:inline-flex;align-items:center;gap:12px;padding:20px 40px;font-size:0.75rem;">
            <span>Start Exploring</span>
            <i class="fas fa-arrow-right" style="font-size:0.7rem;"></i>
        </a>
    </div>
@endif

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
