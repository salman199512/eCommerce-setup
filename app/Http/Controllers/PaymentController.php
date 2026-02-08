<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Auth;

class PaymentController extends Controller
{
    public function checkout()
    {
        $cart = Session::get('cart');
        if (!$cart || count($cart) == 0) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('frontend.checkout.index', compact('cart', 'total'));
    }

    public function placeOrder(Request $request)
    {
        // Simple manual order placement, or redirect to Razorpay
        // This method can handle initial validation and then create Razorpay order

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
        ]);

        // Integrate with Razorpay
        // Create an Order on Razorpay
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $cart = Session::get('cart');
        $total = 0;
        foreach ($cart as $item) $total += $item['price'] * $item['quantity'];

        $orderData = [
            'receipt'         => 'rcptid_'.rand(1000, 9999),
            'amount'          => $total * 100, // Amount in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // Auto capture
        ];

        try {
            $razorpayOrder = $api->order->create($orderData);

            // Return JSON for frontend JS to launch Razorpay
            return response()->json([
                'order_id' => $razorpayOrder['id'],
                'amount' => $orderData['amount'],
                'key' => config('services.razorpay.key'),
                'customer_details' => [
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'email' => $request->email,
                    'contact' => $request->phone
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Create Razorpay Order (Alternative or duplicate if needed by JS directly)
    // The placeOrder above handles this logic for now.

    public function verifyPayment(Request $request)
    {
        $success = true;
        $error = "Payment Failed";

        if (empty($request->razorpay_payment_id) === false)
        {
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

            try
            {
                $attributes = array(
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature
                );

                $api->utility->verifyPaymentSignature($attributes);
            }
            catch(\Exception $e)
            {
                $success = false;
                $error = 'Razorpay Error : ' . $e->getMessage();
            }
        }

        if ($success === true)
        {
            // Payment Successful - Create Order in DB
            $this->storeOrder($request->all()); // Pass customer data

            return redirect()->route('home')->with('success', 'Payment Successful! Your order has been placed.');
        }
        else
        {
            return redirect()->route('checkout')->with('error', $error);
        }
    }

    public function createRazorpayOrder(Request $request)
    {
        // Add Validation
         $request->validate([
            'first_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $cart = Session::get('cart');
        if(!$cart) return response()->json(['error' => 'Cart is empty'], 400);

        $total = 0;
        foreach ($cart as $item) $total += $item['price'] * $item['quantity'];

        $orderData = [
            'receipt'         => 'rcptid_'.rand(1000, 9999),
            'amount'          => $total * 100, // Amount in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // Auto capture
        ];

        try {
            $razorpayOrder = $api->order->create($orderData);

            return response()->json([
                'id' => $razorpayOrder['id'], // Correct key
                'order_id' => $razorpayOrder['id'], // Redundant but safe
                'amount' => $orderData['amount'],
                'key' => config('services.razorpay.key'),
                'customer_details' => [
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'email' => $request->email,
                    'contact' => $request->phone
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function storeOrder($data)
    {
        $cart = Session::get('cart');
        $total = 0;
        foreach ($cart as $item) $total += $item['price'] * $item['quantity'];

        $order = Order::create([
            'user_id' => Auth::guard('web')->user()->id ?? null,
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'subtotal' => $total,
            'total_amount' => $total,
            'payment_status' => 'paid',
            'payment_method' => 'razorpay',
            'transaction_id' => $data['razorpay_payment_id'],
            'status' => 'pending',

            // Customer Info from verify request
            'first_name' => $data['first_name'] ?? 'Guest',
            'last_name' => $data['last_name'] ?? '',
            'email' => $data['email'] ?? 'guest@example.com',
            'phone' => $data['phone'] ?? '',
            'address' => $data['address'] ?? '',
            'city' => $data['city'] ?? '',
            'state' => $data['state'] ?? '',
            'zip_code' => $data['zip_code'] ?? '',
            'country' => 'India'
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'variant_id' => $item['variant_id'] ?? null,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['price'] * $item['quantity']
            ]);
        }

        // Clear cart
        Session::forget('cart');
    }

    public function order_track() {
        return view('frontend.order.track');
    }
}
