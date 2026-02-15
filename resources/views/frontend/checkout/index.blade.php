@extends('frontend.layouts.master')

@section('meta_title', 'Checkout')

@section('content')
<div class="bg-white min-h-screen">
    <!-- Header -->
    <div class="bg-gray-100 py-10 mb-12">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-2">Checkout</h1>
            <p class="text-gray-500 text-sm uppercase tracking-widest">Complete your order</p>
        </div>
    </div>

    <div class="container mx-auto px-4 pb-20">
        <div class="flex flex-col lg:flex-row gap-16">
            <!-- Billing Details -->
            <div class="w-full lg:w-2/3">
                <h2 class="text-2xl font-bold mb-10 border-b pb-4">Billing Details</h2>
                
                <form id="checkout-form" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">First Name</label>
                            <input type="text" name="first_name" class="w-full border-b-2 border-gray-100 py-2 focus:outline-none focus:border-black transition duration-300" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Last Name</label>
                            <input type="text" name="last_name" class="w-full border-b-2 border-gray-100 py-2 focus:outline-none focus:border-black transition duration-300" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Email Address</label>
                            <input type="email" name="email" class="w-full border-b-2 border-gray-100 py-2 focus:outline-none focus:border-black transition duration-300" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Phone Number</label>
                            <input type="text" name="phone" class="w-full border-b-2 border-gray-100 py-2 focus:outline-none focus:border-black transition duration-300" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Shipping Address</label>
                        <input type="text" name="address" class="w-full border-b-2 border-gray-100 py-2 focus:outline-none focus:border-black transition duration-300" placeholder="Street, Apartment, Suite" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">City</label>
                            <input type="text" name="city" class="w-full border-b-2 border-gray-100 py-2 focus:outline-none focus:border-black transition duration-300" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">State</label>
                            <input type="text" name="state" class="w-full border-b-2 border-gray-100 py-2 focus:outline-none focus:border-black transition duration-300" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Zip Code</label>
                            <input type="text" name="zip_code" class="w-full border-b-2 border-gray-100 py-2 focus:outline-none focus:border-black transition duration-300" required>
                        </div>
                    </div>
                    <div class="pt-8 border-t border-gray-100">
                        <h3 class="text-xl font-bold mb-8 uppercase tracking-widest text-black">Payment Method</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-data="{ method: 'online' }">
                            <label class="relative flex items-center p-6 border-2 rounded-3xl cursor-pointer transition-all duration-300 group"
                                   :class="method === 'online' ? 'border-black bg-gray-50' : 'border-gray-100 hover:border-gray-200'">
                                <input type="radio" name="payment_method" value="online" class="hidden" x-model="method">
                                <div class="w-16 h-16 rounded-2xl bg-indigo-500 flex items-center justify-center text-white text-2xl shadow-lg shadow-indigo-100 mr-6 group-hover:scale-110 transition duration-500">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-black text-sm uppercase tracking-widest text-black">Online Payment</h4>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Cards, UPI, Netbanking</p>
                                </div>
                                <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center"
                                     :class="method === 'online' ? 'border-black bg-black text-white' : 'border-gray-200'">
                                    <i class="fa fa-check text-[10px]" x-show="method === 'online'"></i>
                                </div>
                            </label>

                            <label class="relative flex items-center p-6 border-2 rounded-3xl cursor-pointer transition-all duration-300 group"
                                   :class="method === 'cod' ? 'border-black bg-gray-50' : 'border-gray-100 hover:border-gray-200'">
                                <input type="radio" name="payment_method" value="cod" class="hidden" x-model="method">
                                <div class="w-16 h-16 rounded-2xl bg-emerald-500 flex items-center justify-center text-white text-2xl shadow-lg shadow-emerald-100 mr-6 group-hover:scale-110 transition duration-500">
                                    <i class="fa fa-money-bill-wave"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-black text-sm uppercase tracking-widest text-black">Cash On Delivery</h4>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Pay when you receive</p>
                                </div>
                                <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center"
                                     :class="method === 'cod' ? 'border-black bg-black text-white' : 'border-gray-200'">
                                    <i class="fa fa-check text-[10px]" x-show="method === 'cod'"></i>
                                </div>
                            </label>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Order Summary -->
            @php $total = 0; @endphp
            <div class="w-full lg:w-1/3">
                <div class="bg-gray-50 p-10 rounded-3xl border border-gray-100 sticky top-10">
                    <h3 class="font-black text-xl mb-8 border-b pb-6 uppercase tracking-widest text-black">Order Summary</h3>
                    
                    <div class="space-y-6 mb-10">
                        @foreach($cart as $item)
                        @php $total += $item['price'] * $item['quantity']; @endphp
                        <div class="flex justify-between items-start gap-4">
                            <div class="flex gap-4 min-w-0">
                                <div class="w-16 h-20 bg-white rounded-xl border border-gray-100 overflow-hidden flex-shrink-0">
                                    <img src="{{ $item['image'] ?? '' }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[11px] font-black text-black uppercase truncate">{{ $item['name'] }}</p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Qty: {{ $item['quantity'] }}</p>
                                </div>
                            </div>
                            <span class="text-xs font-black text-black tracking-widest shrink-0">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-100 py-8 space-y-4">
                        <div class="flex justify-between text-gray-400 text-[10px] font-black uppercase tracking-widest">
                            <span>Subtotal</span>
                            <span class="text-black">${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-400 text-[10px] font-black uppercase tracking-widest">
                            <span>Shipping</span>
                            <span class="text-emerald-500">Free</span>
                        </div>
                        <div class="flex justify-between items-center border-t border-gray-100 pt-6 mt-4">
                            <span class="text-sm font-black uppercase tracking-widest text-black">Total</span>
                            <span class="text-2xl font-black tracking-tighter text-black">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button id="pay-btn" class="w-full bg-black text-white font-black py-5 uppercase text-[11px] tracking-widest hover:bg-red-600 transition-all duration-500 rounded-2xl shadow-xl shadow-black/10 flex justify-center items-center gap-3 group">
                            <span id="btn-text">Place Order & Pay</span> <i class="fa fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                        </button>
                        <div class="flex items-center justify-center gap-6 mt-8 opacity-30">
                             <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" class="h-3">
                             <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-5">
                             <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" class="h-4">
                        </div>
                        <p class="text-[9px] text-center text-gray-300 mt-8 font-black uppercase tracking-widest flex items-center justify-center gap-2">
                            <i class="fa fa-lock text-[8px]"></i> End-to-end encrypted & secure
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Razorpay Form (Hidden) -->
<form action="{{ route('verifyPayment') }}" method="POST" id="verify-payment-form">
    @csrf
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
    <input type="hidden" name="razorpay_signature" id="razorpay_signature">
    <!-- Pass customer data back for order creation verify -->
    <input type="hidden" name="customer_data" id="customer_data_json">
</form>

@endsection

@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.getElementById('pay-btn').onclick = function(e){
        e.preventDefault();
        
        // Validate Form
        if(!document.getElementById('checkout-form').checkValidity()) {
            document.getElementById('checkout-form').reportValidity();
            return;
        }

        const formData = new FormData(document.getElementById('checkout-form'));
        const customerData = Object.fromEntries(formData);
        
        // Disable button
        const btn = document.getElementById('pay-btn');
        const btnText = document.getElementById('btn-text');
        const originalText = btnText.innerHTML;
        btn.disabled = true;
        btnText.innerHTML = 'Processing...';

        // Place Order (This now handles both COD and Razorpay Order Creation)
        fetch("{{ route('place-order') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(customerData)
        })
        .then(response => response.json())
        .then(data => {
            if(data.error) {
                alert(data.error);
                btn.disabled = false;
                btnText.innerHTML = originalText;
                return;
            }

            if (data.redirect) {
                // COD Flow
                window.location.href = data.redirect + '?success=1';
                return;
            }

            // Online Payment Flow (Razorpay)
            var options = {
                "key": data.key, 
                "amount": data.amount, 
                "currency": "INR",
                "name": "Fashion Store",
                "description": "Premium Order Payment",
                "image": "https://ui-avatars.com/api/?name=Fashion+Store&background=000&color=fff",
                "order_id": data.order_id, 
                "handler": function (response){
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                    document.getElementById('razorpay_signature').value = response.razorpay_signature;
                    
                    // Add customer data to the verify form dynamically
                    for (const [key, value] of Object.entries(customerData)) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = key;
                        input.value = value;
                        document.getElementById('verify-payment-form').appendChild(input);
                    }

                    document.getElementById('verify-payment-form').submit();
                },
                "prefill": {
                    "name": data.customer_details.name,
                    "email": data.customer_details.email,
                    "contact": data.customer_details.contact
                },
                "theme": {
                    "color": "#000000"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function (response){
                alert("Payment Failed: " + response.error.description);
                btn.disabled = false;
                btnText.innerHTML = originalText;
            });
            rzp1.open();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Something went wrong. Please try again.');
            btn.disabled = false;
            btnText.innerHTML = originalText;
        });
    }

    // Update button text based on selection
    document.querySelectorAll('input[name="payment_method"]').forEach(input => {
        input.addEventListener('change', (e) => {
            const btnText = document.getElementById('btn-text');
            if (e.target.value === 'cod') {
                btnText.innerText = 'Confirm Order (COD)';
            } else {
                btnText.innerText = 'Place Order & Pay';
            }
        });
    });
</script>
@endpush
