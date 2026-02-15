<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the user's orders.
     */
    public function index()
    {
        $orders = auth()->user()->orders()
            ->with(['orderItems.variant.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontend.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        // Ensure user can only view their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this order.');
        }

        $order->load(['orderItems.variant.product.media', 'orderItems.variant.attributes.attributeGroup']);

        return view('frontend.orders.show', compact('order'));
    }
}
