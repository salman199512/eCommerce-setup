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
                </form>
            </div>

            <!-- Order Summary -->
            @php $total = 0; @endphp
            <div class="w-full lg:w-1/3">
                <div class="bg-gray-50 p-8 border border-gray-100">
                    <h3 class="font-bold text-xl mb-6 border-b pb-4">Order Summary</h3>
                    
                    <div class="space-y-4 mb-8">
                        @foreach($cart as $item)
                        @php $total += $item['price'] * $item['quantity']; @endphp
                        <div class="flex justify-between items-start">
                            <div class="flex gap-4">
                                <div class="w-16 h-16 bg-white p-1 border border-gray-200 overflow-hidden">
                                    <img src="{{ $item['image'] ?? '' }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900">{{ $item['name'] }}</p>
                                    <p class="text-xs text-gray-500">Qty: {{ $item['quantity'] }}</p>
                                </div>
                            </div>
                            <span class="text-sm font-bold text-gray-900">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-200 py-6 space-y-3">
                        <div class="flex justify-between text-gray-500 text-sm uppercase tracking-widest">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-500 text-sm uppercase tracking-widest">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg text-gray-900 border-t border-gray-200 pt-4 mt-2">
                            <span>Total</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button id="pay-btn" class="w-full bg-black text-white font-bold py-4 uppercase tracking-widest hover:bg-red-600 transition shadow-xl flex justify-center items-center gap-3">
                            Place Order & Pay <i class="fa fa-arrow-right text-xs"></i>
                        </button>
                        <div class="flex items-center justify-center gap-4 mt-8 opacity-20 grayscale">
                             <i class="fab fa-cc-visa text-3xl"></i>
                             <i class="fab fa-cc-mastercard text-3xl"></i>
                             <i class="fab fa-cc-apple-pay text-3xl"></i>
                        </div>
                        <p class="text-[10px] text-center text-gray-400 mt-6 uppercase tracking-widest">
                            <i class="fa fa-shield-alt mr-1"></i> Data encrypted & secure
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
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin mr-2"></i> Processing...';

        // Create Order on Server
        fetch("{{ route('createRazorpayOrder') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json' // Set content type
            },
            body: JSON.stringify(customerData)
        })
        .then(response => response.json())
        .then(data => {
            if(data.error) {
                alert(data.error);
                btn.disabled = false;
                btn.innerHTML = originalText;
                return;
            }

            var options = {
                "key": data.key, 
                "amount": data.amount, 
                "currency": "INR",
                "name": "Fashion Store",
                "description": "Order Payment",
                "image": "https://ui-avatars.com/api/?name=Fashion+Store",
                "order_id": data.order_id, 
                "handler": function (response){
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                    document.getElementById('razorpay_signature').value = response.razorpay_signature;
                    
                    // Also pass customer data to store order
                    // Since we are verifying, we need to pass this data again or store in session. 
                    // Best practice: Store in session during Create Order step, or pass here in hidden input.
                    // For now, simpler: resubmit form data or pass via hidden input?
                    // Actually, submitting the form above is for Razorpay only.
                    // We need to submit the verify form.

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
                    "color": "#DC2626"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function (response){
                alert("Payment Failed: " + response.error.description);
                btn.disabled = false;
                btn.innerHTML = originalText;
            });
            rzp1.open();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Something went wrong. Please try again.');
            btn.disabled = false;
            btn.innerHTML = originalText;
        });
    }
</script>
@endpush
