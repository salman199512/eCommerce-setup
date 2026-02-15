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
            'product_id' => 'required_without:variant_id|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variant_id' => 'nullable|exists:product_variants,id'
        ]);

        if ($request->variant_id) {
            $variant = \App\Models\ProductVariant::with('product.media')->find($request->variant_id);
            $product = $variant->product;
        } else {
            $product = Product::with('media', 'variants')->find($request->product_id);
            $variant = $product->variants->first(); // Point 10 fallback
        }

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.'], 404);
        }

        $cart = Session::get('cart', []);
        $price = $variant ? ($variant->final_price ?? $variant->price) : $product->price;
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

        if ($request->ajax()) {
            return response()->json([
                'success' => true, 
                'message' => 'Piece added to your ARCHIVE.',
                'cartCount' => count($cart),
                'totalQty' => array_sum(array_column($cart, 'quantity'))
            ]);
        }

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
                
                $total = 0;
                $totalQty = 0;
                foreach($cart as $item) {
                    $total += $item['price'] * $item['quantity'];
                    $totalQty += $item['quantity'];
                }
                $runningTotal = $cart[$request->id]['price'] * $cart[$request->id]['quantity'];

                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Cart updated successfully',
                        'total' => number_format($total, 2),
                        'runningTotal' => number_format($runningTotal, 2),
                        'cartCount' => count($cart),
                        'totalQty' => $totalQty
                    ]);
                }

                session()->flash('success', 'Cart updated successfully');
                return redirect()->back();
            }
        }
        return redirect()->back();
    }

    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $cart = Session::get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                Session::put('cart', $cart);
            }

            $total = 0;
            $totalQty = 0;
            foreach($cart as $item) {
                $total += $item['price'] * $item['quantity'];
                $totalQty += $item['quantity'];
            }

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product removed successfully',
                    'total' => number_format($total, 2),
                    'cartCount' => count($cart),
                    'totalQty' => $totalQty
                ]);
            }

            session()->flash('success', 'Product removed successfully');
            return redirect()->back();
        }
        return redirect()->back();
    }
}
