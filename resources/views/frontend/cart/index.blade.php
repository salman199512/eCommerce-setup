@extends('frontend.layouts.master')

@section('meta_title', 'Shopping Cart — FreshMart')

@section('content')

<!-- Page Hero -->
<div class="fm-page-hero" style="padding:40px 0;">
    <div class="hero-content">
        <span class="hero-subtitle">Your Selection</span>
        <h1 class="hero-title" style="font-size:2.6rem;">Shopping Cart</h1>
        <div class="hero-breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="separator">/</span>
            <span class="current">Cart</span>
        </div>
    </div>
</div>

<div style="max-width:1280px;margin:0 auto;padding:48px 24px 80px;">

@if(count($cartItems) > 0)

    <!-- Step Indicator -->
    <div style="display:flex;align-items:center;gap:0;margin-bottom:40px;max-width:480px;">
        <div style="display:flex;align-items:center;gap:8px;font-size:0.72rem;font-weight:800;text-transform:uppercase;letter-spacing:0.08em;color:var(--primary);">
            <span style="width:28px;height:28px;background:var(--primary);color:white;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:900;flex-shrink:0;">1</span>
            Cart
        </div>
        <div style="flex:1;height:2px;background:var(--gray-200);margin:0 12px;"></div>
        <div style="display:flex;align-items:center;gap:8px;font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:var(--gray-300);">
            <span style="width:28px;height:28px;background:var(--gray-200);color:var(--gray-400);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:900;flex-shrink:0;">2</span>
            Checkout
        </div>
        <div style="flex:1;height:2px;background:var(--gray-200);margin:0 12px;"></div>
        <div style="display:flex;align-items:center;gap:8px;font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:var(--gray-300);">
            <span style="width:28px;height:28px;background:var(--gray-200);color:var(--gray-400);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:900;flex-shrink:0;">3</span>
            Done
        </div>
    </div>

    <div style="display:flex;flex-wrap:wrap;gap:32px;align-items:flex-start;">

        <!-- Cart Items -->
        <div style="flex:1;min-width:0;">

            <!-- Table Header -->
            <div style="display:grid;grid-template-columns:2fr 1fr 1fr 1fr auto;gap:12px;padding:0 16px 12px;font-size:0.62rem;font-weight:900;text-transform:uppercase;letter-spacing:0.16em;color:var(--gray-400);border-bottom:2px solid var(--gray-100);">
                <span>Product</span>
                <span>Price</span>
                <span style="text-align:center;">Quantity</span>
                <span style="text-align:right;">Total</span>
                <span></span>
            </div>

            <div id="cart-items-body" style="display:flex;flex-direction:column;gap:4px;margin-top:8px;">
                @foreach($cartItems as $id => $details)
                <div style="display:grid;grid-template-columns:2fr 1fr 1fr 1fr auto;gap:12px;align-items:center;background:white;border:1px solid var(--border-light);border-radius:var(--radius-lg);padding:16px;box-shadow:var(--shadow-sm);transition:box-shadow .2s;" id="cart-row-{{ $id }}"
                     onmouseover="this.style.boxShadow='var(--shadow-md)'" onmouseout="this.style.boxShadow='var(--shadow-sm)'">

                    <!-- Product -->
                    <div style="display:flex;align-items:center;gap:14px;min-width:0;">
                        <div style="width:72px;height:72px;background:var(--gray-50);border-radius:var(--radius-md);overflow:hidden;flex-shrink:0;border:1px solid var(--gray-100);">
                            <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                        <div style="min-width:0;">
                            <div style="font-size:0.82rem;font-weight:800;color:var(--gray-900);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-bottom:3px;">{{ $details['name'] }}</div>
                            @if(isset($details['attributes']))
                            <div style="font-size:0.64rem;font-weight:700;color:var(--gray-400);text-transform:uppercase;letter-spacing:0.08em;">{{ $details['attributes'] }}</div>
                            @endif
                        </div>
                    </div>

                    <!-- Price -->
                    <div>
                        <div style="font-size:0.58rem;font-weight:800;color:var(--gray-300);text-transform:uppercase;letter-spacing:0.1em;margin-bottom:3px;">Unit Price</div>
                        <div style="font-size:0.88rem;font-weight:900;color:var(--gray-900);">${{ number_format($details['price'], 2) }}</div>
                    </div>

                    <!-- Qty -->
                    <div style="display:flex;flex-direction:column;align-items:center;gap:4px;">
                        <div style="font-size:0.58rem;font-weight:800;color:var(--gray-300);text-transform:uppercase;letter-spacing:0.1em;margin-bottom:4px;">Qty</div>
                        <div style="display:inline-flex;align-items:center;background:var(--gray-50);border:1.5px solid var(--gray-200);border-radius:var(--radius-full);height:36px;padding:0 4px;">
                            <button onclick="updateQty('{{ $id }}', -1)" style="width:28px;height:28px;display:flex;align-items:center;justify-content:center;border:none;background:none;cursor:pointer;color:var(--gray-500);font-size:1rem;transition:color .15s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--gray-500)'">&minus;</button>
                            <input type="text" value="{{ $details['quantity'] }}" readonly id="qty-{{ $id }}"
                                   style="width:32px;text-align:center;font-size:0.85rem;font-weight:800;color:var(--gray-900);background:transparent;border:none;outline:none;">
                            <button onclick="updateQty('{{ $id }}', 1)" style="width:28px;height:28px;display:flex;align-items:center;justify-content:center;border:none;background:none;cursor:pointer;color:var(--gray-500);font-size:1rem;transition:color .15s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--gray-500)'">&plus;</button>
                        </div>
                    </div>

                    <!-- Total -->
                    <div style="text-align:right;">
                        <div style="font-size:0.58rem;font-weight:800;color:var(--gray-300);text-transform:uppercase;letter-spacing:0.1em;margin-bottom:3px;">Total</div>
                        <div style="font-size:1rem;font-weight:900;color:var(--primary);" id="total-{{ $id }}">${{ number_format($details['price'] * $details['quantity'], 2) }}</div>
                    </div>

                    <!-- Remove -->
                    <button onclick="removeItem('{{ $id }}')"
                            style="width:36px;height:36px;background:white;border:1.5px solid var(--gray-200);color:var(--gray-300);border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .2s;flex-shrink:0;"
                            onmouseover="this.style.color='var(--red-primary)';this.style.borderColor='var(--red-primary)';this.style.background='var(--red-soft)'"
                            onmouseout="this.style.color='var(--gray-300)';this.style.borderColor='var(--gray-200)';this.style.background='white'">
                        <i class="fas fa-times" style="font-size:0.7rem;"></i>
                    </button>
                </div>
                @endforeach
            </div>

            <!-- Continue Shopping -->
            <div style="margin-top:24px;padding-top:20px;border-top:1px solid var(--gray-100);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
                <a href="{{ route('products') }}" style="display:inline-flex;align-items:center;gap:8px;font-size:0.72rem;font-weight:800;text-transform:uppercase;letter-spacing:0.12em;color:var(--primary);text-decoration:none;transition:gap .2s;" onmouseover="this.style.gap='12px'" onmouseout="this.style.gap='8px'">
                    <i class="fas fa-arrow-left" style="font-size:0.65rem;"></i> Continue Shopping
                </a>
                <div style="font-size:0.72rem;color:var(--gray-400);font-weight:600;">
                    <i class="fas fa-shield-halved" style="color:var(--primary);margin-right:5px;"></i> Secure &amp; encrypted checkout
                </div>
            </div>
        </div>

        <!-- Order Summary Sidebar -->
        <div style="width:340px;flex-shrink:0;position:sticky;top:100px;">
            <div style="background:white;border:1px solid var(--border-light);border-radius:var(--radius-2xl);padding:28px;box-shadow:var(--shadow-md);">
                <h3 style="font-size:0.78rem;font-weight:900;text-transform:uppercase;letter-spacing:0.14em;color:var(--gray-900);margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid var(--gray-100);">
                    <i class="fas fa-receipt" style="color:var(--primary);margin-right:8px;"></i> Order Summary
                </h3>

                <div style="display:flex;flex-direction:column;gap:12px;margin-bottom:16px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;font-size:0.78rem;font-weight:600;color:var(--gray-500);">
                        <span>Subtotal ({{ count($cartItems) }} items)</span>
                        <span class="cart-total" style="font-weight:800;color:var(--gray-900);">${{ number_format($total, 2) }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;align-items:center;font-size:0.78rem;font-weight:600;color:var(--gray-500);">
                        <span>Shipping</span>
                        <span style="font-weight:800;color:var(--primary);">FREE</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;align-items:center;font-size:0.78rem;font-weight:600;color:var(--gray-500);">
                        <span>Estimated Tax</span>
                        <span style="font-weight:700;color:var(--gray-600);">Calculated at checkout</span>
                    </div>
                </div>

                <div style="padding:16px 0;border-top:2px solid var(--gray-100);border-bottom:1px solid var(--gray-100);margin-bottom:20px;display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:0.85rem;font-weight:900;text-transform:uppercase;letter-spacing:0.08em;color:var(--gray-900);">Total</span>
                    <span class="cart-total" style="font-size:1.6rem;font-weight:900;color:var(--primary);letter-spacing:-0.03em;">${{ number_format($total, 2) }}</span>
                </div>

                <a href="{{ route('checkout') }}" class="fm-btn-vibrant" style="display:flex;justify-content:center;align-items:center;gap:10px;width:100%;padding:16px;font-size:0.78rem;text-decoration:none;margin-bottom:14px;">
                    <i class="fas fa-lock" style="font-size:0.7rem;"></i> Proceed to Checkout
                </a>

                <a href="{{ route('products') }}" style="display:flex;justify-content:center;align-items:center;gap:8px;width:100%;padding:12px;font-size:0.72rem;font-weight:800;text-transform:uppercase;letter-spacing:0.1em;color:var(--gray-500);text-decoration:none;border:1.5px solid var(--gray-200);border-radius:var(--radius-full);transition:all .2s;" onmouseover="this.style.borderColor='var(--gray-400)';this.style.color='var(--gray-800)'" onmouseout="this.style.borderColor='var(--gray-200)';this.style.color='var(--gray-500)'">
                    Continue Shopping
                </a>

                <!-- Payment Icons -->
                <div style="margin-top:20px;padding-top:16px;border-top:1px solid var(--gray-100);display:flex;align-items:center;justify-content:center;gap:12px;">
                    <span style="font-size:0.6rem;font-weight:700;color:var(--gray-300);text-transform:uppercase;letter-spacing:.08em;">We accept:</span>
                    <i class="fab fa-cc-visa" style="font-size:1.4rem;color:var(--gray-300);"></i>
                    <i class="fab fa-cc-mastercard" style="font-size:1.4rem;color:var(--gray-300);"></i>
                    <i class="fab fa-cc-paypal" style="font-size:1.4rem;color:var(--gray-300);"></i>
                    <i class="fab fa-cc-apple-pay" style="font-size:1.4rem;color:var(--gray-300);"></i>
                </div>

                <!-- Trust Badges -->
                <div style="margin-top:14px;display:flex;flex-direction:column;gap:7px;">
                    <div style="display:flex;align-items:center;gap:7px;font-size:0.68rem;font-weight:600;color:var(--gray-400);">
                        <i class="fas fa-lock" style="color:var(--primary);font-size:0.72rem;"></i> SSL Encrypted &amp; Secure
                    </div>
                    <div style="display:flex;align-items:center;gap:7px;font-size:0.68rem;font-weight:600;color:var(--gray-400);">
                        <i class="fas fa-rotate-left" style="color:var(--secondary);font-size:0.72rem;"></i> 7-Day Easy Returns
                    </div>
                    <div style="display:flex;align-items:center;gap:7px;font-size:0.68rem;font-weight:600;color:var(--gray-400);">
                        <i class="fas fa-truck-fast" style="color:var(--teal-primary);font-size:0.72rem;"></i> Free Delivery Over $49
                    </div>
                </div>
            </div>
        </div>
    </div>

@else
    <!-- Empty Cart -->
    <div style="padding:80px 24px;text-align:center;background:white;border:2px dashed var(--gray-200);border-radius:var(--radius-2xl);">
        <div style="width:88px;height:88px;background:var(--gray-50);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;box-shadow:var(--shadow-md);">
            <i class="fas fa-cart-shopping" style="font-size:2rem;color:var(--gray-200);"></i>
        </div>
        <h3 style="font-size:1.6rem;font-weight:900;color:var(--gray-900);margin-bottom:10px;">Your cart is empty</h3>
        <p style="color:var(--gray-400);font-size:0.85rem;font-weight:500;max-width:360px;margin:0 auto 32px;line-height:1.7;">
            Looks like you haven't added any fresh groceries yet. Browse our store to discover amazing products!
        </p>
        <a href="{{ route('products') }}" class="fm-btn-vibrant" style="display:inline-flex;align-items:center;gap:10px;padding:14px 36px;font-size:0.78rem;text-decoration:none;width:auto;">
            <i class="fas fa-store" style="font-size:0.75rem;"></i> Start Shopping
        </a>
    </div>
@endif

</div>

@endsection

@push('styles')
<style>
@media (max-width: 900px) {
    .cart-layout-wrap { flex-direction: column !important; }
    .cart-summary-sidebar { width: 100% !important; position: static !important; }
    .cart-item-row { grid-template-columns: 1fr auto !important; }
}
@media (max-width: 640px) {
    .cart-item-row { display: flex !important; flex-direction: column !important; }
}
</style>
@endpush

@push('scripts')
<script>
    function updateQty(id, delta) {
        let el = document.getElementById('qty-' + id);
        let newQty = parseInt(el.value) + delta;
        if (newQty < 1) return;
        el.value = newQty;
        $('#cart-row-' + id).css('opacity', '0.6');
        $.ajax({
            url: "{{ route('update.cart') }}",
            type: "PATCH",
            data: { id: id, quantity: newQty, _token: "{{ csrf_token() }}" },
            success: function(response) {
                if (response.success) {
                    $('#total-' + id).text('$' + response.runningTotal);
                    $('.cart-total').text('$' + response.total);
                    $('.cart-count-global').text(response.totalQty);
                    $('.cart-items-count').text(response.cartCount);
                    $('#cart-row-' + id).css('opacity', '1');
                }
            },
            error: function() { location.reload(); }
        });
    }

    function removeItem(id) {
        if (!confirm('Remove this item from your cart?')) return;
        $('#cart-row-' + id).fadeOut(400, function() {
            $.ajax({
                url: "{{ route('remove.from.cart') }}",
                type: "DELETE",
                data: { id: id, _token: "{{ csrf_token() }}" },
                success: function(response) {
                    if (response.success) {
                        $('.cart-total').text('$' + response.total);
                        $('.cart-count-global').text(response.totalQty);
                        $('.cart-items-count').text(response.cartCount);
                        if (response.cartCount === 0) location.reload();
                    }
                }
            });
        });
    }
</script>
@endpush
