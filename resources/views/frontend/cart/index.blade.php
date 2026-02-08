@extends('frontend.layouts.master')

@section('meta_title', 'Shopping Cart')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Shopping Cart</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cartItems) > 0)
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Cart Items -->
        <div class="w-full md:w-3/4">
            <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-500 font-bold">
                            <th class="p-4">Product</th>
                            <th class="p-4">Price</th>
                            <th class="p-4 text-center">Quantity</th>
                            <th class="p-4 text-right">Running Total</th>
                            <th class="p-4"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($cartItems as $id => $details)
                        <tr x-data="{ qty: {{ $details['quantity'] }} }">
                            <td class="p-4 flex items-center gap-4">
                                <div class="w-16 h-16 flex-shrink-0 bg-gray-100 rounded overflow-hidden">
                                    <img src="{{ $details['image'] ?? 'https://ui-avatars.com/api/?name='.urlencode($details['name']) }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">{{ $details['name'] }}</h3>
                                    @if(isset($details['attributes']) && $details['attributes'])
                                        <p class="text-xs text-gray-500">{{ $details['attributes'] }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="p-4 text-gray-600">${{ number_format($details['price'], 2) }}</td>
                            <td class="p-4 text-center">
                                <form action="{{ route('update.cart') }}" method="POST" class="flex justify-center items-center cart-update-form">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-16 text-center border border-gray-300 rounded p-1" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td class="p-4 text-right font-bold text-gray-800">
                                ${{ number_format($details['price'] * $details['quantity'], 2) }}
                            </td>
                            <td class="p-4 text-right">
                                <form action="{{ route('remove.from.cart') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">
                <a href="{{ route('products') }}" class="text-blue-600 hover:underline"><i class="fa fa-arrow-left mr-2"></i> Continue Shopping</a>
            </div>
        </div>

        <!-- Summary -->
        <div class="w-full md:w-1/4">
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 sticky top-24">
                <h3 class="font-bold text-lg mb-4 border-b pb-2">Order Summary</h3>
                <div class="flex justify-between mb-2 text-sm text-gray-600">
                    <span>Subtotal</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                 <div class="flex justify-between mb-2 text-sm text-gray-600">
                    <span>Shipping</span>
                    <span>Free</span>
                </div>
                <div class="flex justify-between mt-4 pt-4 border-t border-gray-200 font-bold text-lg">
                    <span>Total</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                
                <a href="{{ route('checkout') }}" class="block w-full bg-black text-white text-center py-3 rounded mt-6 font-bold hover:bg-gray-800 transition">Proceed to Checkout</a>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-16">
        <i class="fa fa-shopping-cart text-6xl text-gray-200 mb-4"></i>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Your cart is empty</h2>
        <p class="text-gray-500 mb-6">Looks like you haven't added anything to your cart yet.</p>
        <a href="{{ route('products') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded font-bold hover:bg-blue-700 transition">Start Shopping</a>
    </div>
    @endif
</div>
@endsection
