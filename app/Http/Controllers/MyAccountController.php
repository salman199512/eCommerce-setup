<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Auth;
use Hash;

class MyAccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if(!$user) {
            return redirect()->route('login');
        }

        $orders = Order::where('user_id', $user->id)->latest()->get();

        return view('frontend.account.index', compact('user', 'orders'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('frontend.account.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:8|confirmed'
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->password) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return back()->with('success', 'Profile updated successfully!');
    }
}
