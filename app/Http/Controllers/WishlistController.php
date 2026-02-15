<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Auth;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Please login to add items to your wishlist.']);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $exists = Wishlist::where('user_id', Auth::id())
                          ->where('product_id', $request->product_id)
                          ->exists();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'This piece is already in your ARCHIVE.']);
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id
        ]);

        return response()->json(['success' => true, 'message' => 'Piece added to your ARCHIVE.']);
    }

    public function viewWishlist()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())
                                ->with(['product.media', 'product.category', 'product.variants'])
                                ->latest()
                                ->get();

        return view('frontend.wishlist.index', compact('wishlistItems'));
    }

    public function remove(Request $request)
    {
        $request->validate(['id' => 'required|exists:wishlists,id']);
        
        $wishlist = Wishlist::where('user_id', Auth::id())->where('id', $request->id)->first();
        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['success' => true, 'message' => 'Piece removed from ARCHIVE.']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }
}
