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
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'payment_method' => 'required|in:cod,online'
        ]);

        $cart = Session::get('cart');
        if (!$cart || count($cart) == 0) {
            return response()->json(['error' => 'Your cart is empty'], 400);
        }

        if ($request->payment_method === 'cod') {
            $order = $this->storeOrder($request->all(), 'cod', 'pending');
            return response()->json([
                'success' => true,
                'redirect' => route('home'),
                'message' => 'Order placed successfully with Cash on Delivery!'
            ]);
        }

        // Online Payment - Create Razorpay Order
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        $total = 0;
        foreach ($cart as $item) $total += $item['price'] * $item['quantity'];

        $orderData = [
            'receipt'         => 'rcptid_'.rand(1000, 9999),
            'amount'          => round($total * 100), // Amount in paise
            'currency'        => 'INR',
            'payment_capture' => 1
        ];

        try {
            $razorpayOrder = $api->order->create($orderData);
            return response()->json([
                'payment_method' => 'online',
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

    public function verifyPayment(Request $request)
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        try {
            $attributes = array(
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            );

            $api->utility->verifyPaymentSignature($attributes);
            
            // Payment Successful - Create Order in DB
            $this->storeOrder($request->all(), 'online', 'paid', $request->razorpay_payment_id);

            return redirect()->route('home')->with('success', 'Payment Successful! Your order has been placed.');
        } catch(\Exception $e) {
            return redirect()->route('checkout')->with('error', 'Razorpay Error: ' . $e->getMessage());
        }
    }

    private function storeOrder($data, $method, $status, $transactionId = null)
    {
        $cart = Session::get('cart');
        $total = 0;
        foreach ($cart as $item) $total += $item['price'] * $item['quantity'];

        $order = Order::create([
            'user_id' => Auth::guard('web')->user()->id ?? null,
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'subtotal' => $total,
            'total_amount' => $total,
            'payment_status' => $status,
            'payment_method' => $method,
            'transaction_id' => $transactionId,
            'status' => 'pending',
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'] ?? '',
            'zip_code' => $data['zip_code'],
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

        Session::forget('cart');
        return $order;
    }

    public function order_track() {
        return view('frontend.order.track');
    }
}
