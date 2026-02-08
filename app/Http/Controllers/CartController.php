<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variant_id' => 'nullable|exists:product_variants,id'
        ]);

        $product = Product::with('media', 'variants')->find($request->product_id);

        $cart = Session::get('cart', []);

        $price = $product->price; // Default or fallback logic
        $variant = null;

        // If variant selected
        if ($request->variant_id) {
            $variant = $product->variants->find($request->variant_id);
            if ($variant) {
                $price = $variant->final_price ?? $variant->price;
            }
        } elseif ($product->variants->count() > 0) {
            // Should select a variant ideally, but fallback to min price or error
            // For now, assume min_price if not selected (or force selection usually)
            $price = $product->variants->min('price');
        }

        // Unique ID including variant (e.g., 10_5 for product 10 variant 5)
        $cartItemId = $product->id . ($variant ? '_' . $variant->id : '');

        if (isset($cart[$cartItemId])) {
            $cart[$cartItemId]['quantity'] += $request->quantity;
        } else {
            $cart[$cartItemId] = [
                'name' => $product->title,
                'quantity' => $request->quantity,
                'price' => $price,
                'product_id' => $product->id,
                'variant_id' => $variant ? $variant->id : null,
                'image' => $product->avatar_url,
                'attributes' => $variant ? $variant->attributes->map(function($a) { return "{$a->attributeGroup->title}: {$a->title}"; })->implode(', ') : '' 
            ];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function viewCart()
    {
        $cartItems = Session::get('cart', []);
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('frontend.cart.index', compact('cartItems', 'total'));
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = Session::get('cart');
            if(isset($cart[$request->id])) {
                $cart[$request->id]['quantity'] = $request->quantity;
                Session::put('cart', $cart);
                session()->flash('success', 'Cart updated successfully');
            }
        }
    }

    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $cart = Session::get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                Session::put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
