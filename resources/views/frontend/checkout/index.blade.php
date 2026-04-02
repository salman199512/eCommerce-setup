@extends('frontend.layouts.master')

@section('meta_title', 'Checkout — FreshMart')

@section('content')

<!-- Page Hero -->
<div class="fm-page-hero" style="padding:40px 0;">
    <div class="hero-content">
        <span class="hero-subtitle">Almost there</span>
        <h1 class="hero-title" style="font-size:2.6rem;">Checkout</h1>
        <div class="hero-breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="separator">/</span>
            <a href="{{ route('cart') }}">Cart</a>
            <span class="separator">/</span>
            <span class="current">Checkout</span>
        </div>
    </div>
</div>

<div style="max-width:1280px;margin:0 auto;padding:48px 24px 80px;">

    <!-- Step Indicator -->
    <div style="display:flex;align-items:center;gap:0;margin-bottom:40px;max-width:480px;">
        <div style="display:flex;align-items:center;gap:8px;font-size:0.72rem;font-weight:800;text-transform:uppercase;letter-spacing:0.08em;color:var(--gray-400);">
            <span style="width:28px;height:28px;background:var(--primary);color:white;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:900;flex-shrink:0;"><i class="fas fa-check" style="font-size:0.6rem;"></i></span>
            Cart
        </div>
        <div style="flex:1;height:2px;background:var(--primary);margin:0 12px;"></div>
        <div style="display:flex;align-items:center;gap:8px;font-size:0.72rem;font-weight:900;text-transform:uppercase;letter-spacing:0.08em;color:var(--primary);">
            <span style="width:28px;height:28px;background:var(--primary);color:white;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:900;flex-shrink:0;">2</span>
            Checkout
        </div>
        <div style="flex:1;height:2px;background:var(--gray-200);margin:0 12px;"></div>
        <div style="display:flex;align-items:center;gap:8px;font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:var(--gray-300);">
            <span style="width:28px;height:28px;background:var(--gray-200);color:var(--gray-400);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:900;flex-shrink:0;">3</span>
            Confirm
        </div>
    </div>

    <div style="display:flex;flex-wrap:wrap;gap:32px;align-items:flex-start;">

        <!-- Billing Details Form -->
        <div style="flex:1;min-width:300px;">

            <div style="background:white;border:1px solid var(--border-light);border-radius:var(--radius-2xl);padding:32px;box-shadow:var(--shadow-sm);margin-bottom:24px;">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:24px;padding-bottom:16px;border-bottom:1px solid var(--gray-100);">
                    <div style="width:36px;height:36px;background:var(--primary-soft);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:0.9rem;flex-shrink:0;">
                        <i class="fas fa-user"></i>
                    </div>
                    <h2 style="font-size:0.9rem;font-weight:900;color:var(--gray-900);text-transform:uppercase;letter-spacing:0.06em;">Billing Details</h2>
                </div>

                <form id="checkout-form" style="display:flex;flex-direction:column;gap:20px;">
                    @csrf
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div class="fm-group" style="margin-bottom:0;">
                            <label class="fm-label">First Name <span style="color:var(--red-primary);">*</span></label>
                            <input type="text" name="first_name" class="fm-input" placeholder="John" required>
                        </div>
                        <div class="fm-group" style="margin-bottom:0;">
                            <label class="fm-label">Last Name <span style="color:var(--red-primary);">*</span></label>
                            <input type="text" name="last_name" class="fm-input" placeholder="Doe" required>
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div class="fm-group" style="margin-bottom:0;">
                            <label class="fm-label">Email Address <span style="color:var(--red-primary);">*</span></label>
                            <input type="email" name="email" class="fm-input" placeholder="john@example.com" required>
                        </div>
                        <div class="fm-group" style="margin-bottom:0;">
                            <label class="fm-label">Phone Number <span style="color:var(--red-primary);">*</span></label>
                            <input type="text" name="phone" class="fm-input" placeholder="+1 234 567 890" required>
                        </div>
                    </div>

                    <div class="fm-group" style="margin-bottom:0;">
                        <label class="fm-label">Shipping Address <span style="color:var(--red-primary);">*</span></label>
                        <input type="text" name="address" class="fm-input" placeholder="Street, Apartment, Suite" required>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;">
                        <div class="fm-group" style="margin-bottom:0;">
                            <label class="fm-label">City <span style="color:var(--red-primary);">*</span></label>
                            <input type="text" name="city" class="fm-input" placeholder="City" required>
                        </div>
                        <div class="fm-group" style="margin-bottom:0;">
                            <label class="fm-label">State <span style="color:var(--red-primary);">*</span></label>
                            <input type="text" name="state" class="fm-input" placeholder="State" required>
                        </div>
                        <div class="fm-group" style="margin-bottom:0;">
                            <label class="fm-label">ZIP Code <span style="color:var(--red-primary);">*</span></label>
                            <input type="text" name="zip_code" class="fm-input" placeholder="12345" required>
                        </div>
                    </div>

            </div>

            <!-- Payment Method -->
            <div style="background:white;border:1px solid var(--border-light);border-radius:var(--radius-2xl);padding:32px;box-shadow:var(--shadow-sm);">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:24px;padding-bottom:16px;border-bottom:1px solid var(--gray-100);">
                    <div style="width:36px;height:36px;background:var(--secondary-soft);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;color:var(--secondary);font-size:0.9rem;flex-shrink:0;">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h3 style="font-size:0.9rem;font-weight:900;color:var(--gray-900);text-transform:uppercase;letter-spacing:0.06em;">Payment Method</h3>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;" x-data="{ method: 'online' }">

                    <!-- Online Payment -->
                    <label class="payment-method-card" :class="{ 'active': method === 'online' }">
                        <input type="radio" name="payment_method" value="online" style="display:none;" x-model="method">
                        <div style="width:52px;height:52px;border-radius:var(--radius-lg);background:var(--primary);display:flex;align-items:center;justify-content:center;color:white;font-size:1.3rem;box-shadow:var(--shadow-green);flex-shrink:0;">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:0.8rem;font-weight:900;text-transform:uppercase;letter-spacing:0.06em;color:var(--gray-900);">Online Payment</div>
                            <div style="font-size:0.62rem;color:var(--gray-400);font-weight:700;text-transform:uppercase;letter-spacing:0.06em;margin-top:3px;">Cards · UPI · Netbanking</div>
                        </div>
                        <div class="payment-check">
                            <i class="fas fa-check"></i>
                        </div>
                    </label>

                    <!-- Cash on Delivery -->
                    <label class="payment-method-card" :class="{ 'active': method === 'cod' }">
                        <input type="radio" name="payment_method" value="cod" style="display:none;" x-model="method">
                        <div style="width:52px;height:52px;border-radius:var(--radius-lg);background:var(--secondary);display:flex;align-items:center;justify-content:center;color:white;font-size:1.3rem;box-shadow:var(--shadow-orange);flex-shrink:0;">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:0.8rem;font-weight:900;text-transform:uppercase;letter-spacing:0.06em;color:var(--gray-900);">Cash on Delivery</div>
                            <div style="font-size:0.62rem;color:var(--gray-400);font-weight:700;text-transform:uppercase;letter-spacing:0.06em;margin-top:3px;">Pay when you receive</div>
                        </div>
                        <div class="payment-check">
                            <i class="fas fa-check"></i>
                        </div>
                    </label>
                </div>
            </div>
        </form>
    </div>

        <!-- Order Summary -->
        @php $total = 0; @endphp
        <div style="width:360px;flex-shrink:0;position:sticky;top:100px;">
            <div style="background:white;border:1px solid var(--border-light);border-radius:var(--radius-2xl);padding:28px;box-shadow:var(--shadow-md);">
                <div style="font-size:0.7rem;font-weight:900;text-transform:uppercase;letter-spacing:0.16em;color:var(--gray-400);margin-bottom:20px;padding-bottom:14px;border-bottom:1px solid var(--gray-100);">
                    <i class="fas fa-receipt" style="color:var(--primary);margin-right:6px;"></i> Order Summary
                </div>

                <!-- Cart Items -->
                <div class="fm-scrollbar-thin" style="display:flex;flex-direction:column;gap:12px;margin-bottom:16px;max-height:260px;overflow-y:auto;padding-right:12px;">
                    @foreach($cart as $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div style="width:52px;height:52px;background:var(--gray-50);border-radius:var(--radius-md);overflow:hidden;flex-shrink:0;border:1px solid var(--gray-100);">
                            <img src="{{ $item['image'] ?? '' }}" alt="{{ $item['name'] }}" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:0.75rem;font-weight:800;color:var(--gray-900);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $item['name'] }}</div>
                            <div style="font-size:0.64rem;font-weight:700;color:var(--gray-400);margin-top:2px;">Qty: {{ $item['quantity'] }}</div>
                        </div>
                        <div style="font-size:0.8rem;font-weight:900;color:var(--gray-900);flex-shrink:0;">₹{{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                    </div>
                    @endforeach
                </div>

                <!-- Totals -->
                <div style="border-top:1px solid var(--gray-100);padding-top:14px;display:flex;flex-direction:column;gap:10px;margin-bottom:16px;">
                    <div style="display:flex;justify-content:space-between;font-size:0.75rem;font-weight:600;color:var(--gray-500);">
                        <span>Subtotal</span><span style="color:var(--gray-900);font-weight:700;">₹{{ number_format($total, 2) }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;font-size:0.75rem;font-weight:600;color:var(--gray-500);">
                        <span>Shipping</span><span style="color:var(--primary);font-weight:800;">Free</span>
                    </div>
                </div>

                <div style="display:flex;justify-content:space-between;align-items:center;padding:14px 0;border-top:2px solid var(--gray-100);border-bottom:1px solid var(--gray-100);margin-bottom:20px;">
                    <span style="font-size:0.82rem;font-weight:900;text-transform:uppercase;letter-spacing:0.08em;color:var(--gray-900);">Total</span>
                    <span style="font-size:1.5rem;font-weight:900;color:var(--primary);letter-spacing:-0.03em;">₹{{ number_format($total, 2) }}</span>
                </div>

                <button id="pay-btn" class="fm-btn-vibrant" style="display:flex;justify-content:center;align-items:center;gap:10px;width:100%;padding:17px;font-size:0.78rem;margin-bottom:16px;">
                    <i class="fas fa-lock" style="font-size:0.7rem;"></i>
                    <span id="btn-text">Place Order &amp; Pay</span>
                </button>

                <!-- Security Note -->
                <div style="display:flex;flex-direction:column;gap:7px;padding-top:14px;border-top:1px solid var(--gray-100);">
                    <div style="display:flex;align-items:center;gap:7px;font-size:0.65rem;font-weight:600;color:var(--gray-400);">
                        <i class="fas fa-lock" style="color:var(--primary);"></i> SSL Encrypted &amp; Secure
                    </div>
                    <div style="display:flex;align-items:center;gap:7px;font-size:0.65rem;font-weight:600;color:var(--gray-400);">
                        <i class="fas fa-shield-halved" style="color:var(--teal-primary);"></i> Protected by Razorpay
                    </div>
                </div>

                <!-- Payment logos -->
                <div style="margin-top:14px;display:flex;align-items:center;justify-content:center;gap:10px;opacity:0.35;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" style="height:10px;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" style="height:18px;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" style="height:14px;">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Razorpay Hidden Form (functionality unchanged) -->
<form action="{{ route('verifyPayment') }}" method="POST" id="verify-payment-form">
    @csrf
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
    <input type="hidden" name="razorpay_signature" id="razorpay_signature">
    <input type="hidden" name="customer_data" id="customer_data_json">
</form>

@endsection

@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.getElementById('pay-btn').onclick = function(e){
        e.preventDefault();
        if(!document.getElementById('checkout-form').checkValidity()) {
            document.getElementById('checkout-form').reportValidity();
            return;
        }
        const formData = new FormData(document.getElementById('checkout-form'));
        const customerData = Object.fromEntries(formData);
        const btn = document.getElementById('pay-btn');
        const btnText = document.getElementById('btn-text');
        const originalText = btnText.innerHTML;
        btn.disabled = true;
        btnText.innerHTML = 'Processing... <i class="fas fa-spinner fa-spin"></i>';
        fetch("{{ route('place-order') }}", {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json', 'Content-Type': 'application/json' },
            body: JSON.stringify(customerData)
        })
        .then(response => response.json())
        .then(data => {
            if(data.error) { alert(data.error); btn.disabled = false; btnText.innerHTML = originalText; return; }
            if (data.redirect) { window.location.href = data.redirect + '?success=1'; return; }
            var options = {
                "key": data.key, "amount": data.amount, "currency": "INR",
                "name": "FreshMart", "description": "Organic Grocery Payment",
                "image": "https://ui-avatars.com/api/?name=Fresh+Mart&background=16a34a&color=fff",
                "order_id": data.order_id,
                "handler": function (response){
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                    document.getElementById('razorpay_signature').value = response.razorpay_signature;
                    for (const [key, value] of Object.entries(customerData)) {
                        const input = document.createElement('input');
                        input.type = 'hidden'; input.name = key; input.value = value;
                        document.getElementById('verify-payment-form').appendChild(input);
                    }
                    document.getElementById('verify-payment-form').submit();
                },
                "prefill": { "name": data.customer_details.name, "email": data.customer_details.email, "contact": data.customer_details.contact },
                "theme": { "color": "#16a34a" }
            };
            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function (response){ alert("Payment Failed: " + response.error.description); btn.disabled = false; btnText.innerHTML = originalText; });
            rzp1.open();
        })
        .catch(error => { console.error('Error:', error); alert('Something went wrong. Please try again.'); btn.disabled = false; btnText.innerHTML = originalText; });
    }
    document.querySelectorAll('input[name="payment_method"]').forEach(input => {
        input.addEventListener('change', (e) => {
            const btnText = document.getElementById('btn-text');
            btnText.innerText = e.target.value === 'cod' ? 'Confirm Order (COD)' : 'Place Order & Pay';
        });
    });
</script>
@endpush
