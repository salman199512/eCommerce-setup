<!DOCTYPE html>
<html>
<head>
    <title>Razorpay Checkout</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container">
    <h2>Razorpay Payment</h2>
    <form id="payment-form">
        <div>
            <label>Amount (₹):</label>
            <input type="number" id="amount" value="100" required>
        </div>
        <div>
            <label>Name:</label>
            <input type="text" id="name" value="John Doe" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" id="email" value="john@example.com" required>
        </div>
        <div>
            <label>Contact:</label>
            <input type="tel" id="contact" value="9999999999" required>
        </div>
        <button type="submit">Pay Now</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('#payment-form').on('submit', function(e) {
            e.preventDefault();

            const amount = $('#amount').val();
            const name = $('#name').val();
            const email = $('#email').val();
            const contact = $('#contact').val();

            // Create order
            $.ajax({
                url: '/create-order',
                method: 'POST',
                data: {
                    amount: amount,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var options = {
                        key: response.key,
                        amount: response.amount,
                        currency: response.currency,
                        name: 'RamdevOils',
                        description: 'Payment for your order',
                        order_id: response.order_id,
                        prefill: {
                            name: name,
                            email: email,
                            contact: contact
                        },
                        theme: {
                            color: '#eea200'
                        },
                        handler: function(response) {
                            // Verify payment
                            $.ajax({
                                url: '/verify-payment',
                                method: 'POST',
                                data: {
                                    razorpay_order_id: response.razorpay_order_id,
                                    razorpay_payment_id: response.razorpay_payment_id,
                                    razorpay_signature: response.razorpay_signature,
                                    _token: $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(verifyResponse) {
                                    if (verifyResponse.success) {
                                        alert('Payment successful!');
                                        // Redirect to success page
                                    } else {
                                        alert('Payment verification failed!');
                                    }
                                },
                                error: function() {
                                    alert('Payment verification failed!');
                                }
                            });
                        },
                        modal: {
                            ondismiss: function() {
                                alert('Payment cancelled');
                            }
                        }
                    };

                    var rzp = new Razorpay(options);
                    rzp.open();
                },
                error: function() {
                    alert('Error creating order');
                }
            });
        });
    });
</script>
</body>
</html>
