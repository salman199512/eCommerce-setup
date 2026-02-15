@extends('frontend.layouts.master')

@section('meta_title', 'My Account')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar -->
        <div class="w-full md:w-1/4">
            <div class="bg-white shadow-sm border border-gray-200 rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-400">
                             <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}" class="rounded-full w-full h-full">
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Hello,</p>
                            <h3 class="font-bold text-gray-800">{{ $user->name }}</h3>
                        </div>
                    </div>
                </div>
                <nav class="flex flex-col p-2 space-y-1">
                    <button @click="activeTab = 'dashboard'" :class="{'bg-gray-100 text-black font-bold': activeTab === 'dashboard', 'text-gray-600 hover:bg-gray-50': activeTab !== 'dashboard'}" class="text-left px-4 py-3 rounded transition flex items-center gap-3">
                        <i class="fas fa-th-large w-5 text-center"></i> Dashboard
                    </button>
                    <button @click="activeTab = 'orders'" :class="{'bg-gray-100 text-black font-bold': activeTab === 'orders', 'text-gray-600 hover:bg-gray-50': activeTab !== 'orders'}" class="text-left px-4 py-3 rounded transition flex items-center gap-3">
                        <i class="fas fa-shopping-bag w-5 text-center"></i> My Orders
                    </button>
                    <button @click="activeTab = 'profile'" :class="{'bg-gray-100 text-black font-bold': activeTab === 'profile', 'text-gray-600 hover:bg-gray-50': activeTab !== 'profile'}" class="text-left px-4 py-3 rounded transition flex items-center gap-3">
                        <i class="fas fa-user w-5 text-center"></i> Account Details
                    </button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3 rounded transition flex items-center gap-3 text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt w-5 text-center"></i> Logout
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        <!-- Content -->
        <div class="w-full md:w-3/4" x-data="{ activeTab: 'dashboard' }">
            <!-- Dashboard Tab -->
            <div x-show="activeTab === 'dashboard'" class="bg-white shadow-sm border border-gray-200 rounded-lg p-8">
                <h2 class="text-2xl font-bold mb-6">Overview</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gray-50 p-6 rounded border border-gray-100 text-center">
                        <h4 class="text-gray-500 uppercase text-xs tracking-widest mb-2">Total Orders</h4>
                        <p class="text-4xl font-bold">{{ $orders->count() }}</p>
                    </div>
                     <div class="bg-gray-50 p-6 rounded border border-gray-100 text-center">
                        <h4 class="text-gray-500 uppercase text-xs tracking-widest mb-2">Pending</h4>
                        <p class="text-4xl font-bold text-yellow-600">{{ $orders->where('status', 'pending')->count() }}</p>
                    </div>
                     <div class="bg-gray-50 p-6 rounded border border-gray-100 text-center">
                        <h4 class="text-gray-500 uppercase text-xs tracking-widest mb-2">Completed</h4>
                        <p class="text-4xl font-bold text-green-600">{{ $orders->where('status', 'delivered')->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Orders Tab -->
            <div x-show="activeTab === 'orders'" class="bg-white shadow-sm border border-gray-200 rounded-lg p-8" style="display: none;">
                <h2 class="text-2xl font-bold mb-6">My Orders</h2>
                @if($orders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-xs uppercase text-gray-500 font-bold border-b border-gray-100">
                                <th class="p-4">Order #</th>
                                <th class="p-4">Date</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-right">Total</th>
                                <th class="p-4"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($orders as $order)
                            <tr>
                                <td class="p-4 font-bold">#{{ $order->order_number }}</td>
                                <td class="p-4 text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="p-4">
                                    <span class="px-2 py-1 text-xs rounded uppercase font-bold 
                                        @if($order->status == 'pending') bg-yellow-100 text-yellow-800 
                                        @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                        @elseif($order->status == 'delivered') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-right font-bold">${{ number_format($order->total_amount, 2) }}</td>
                                <td class="p-4 text-right">
                                    {{-- <a href="#" class="text-red-600 hover:underline text-sm font-bold">View</a> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <p class="text-gray-500">No orders found.</p>
                @endif
            </div>

            <!-- Profile Tab -->
            <div x-show="activeTab === 'profile'" class="bg-white shadow-sm border border-gray-200 rounded-lg p-8" style="display: none;">
                <h2 class="text-2xl font-bold mb-6">Account Details</h2>
                <form action="{{ route('account.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="block w-full border-gray-300 rounded-none border-b-2 p-3 focus:border-black focus:ring-0 focus:outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="block w-full border-gray-300 rounded-none border-b-2 p-3 focus:border-black focus:ring-0 focus:outline-none transition">
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-6 mt-6">
                        <h3 class="text-lg font-bold mb-4">Change Password <span class="text-sm font-normal text-gray-400">(Leave blank to keep current)</span></h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                <input type="password" name="password" class="block w-full border-gray-300 rounded-none border-b-2 p-3 focus:border-black focus:ring-0 focus:outline-none transition">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="block w-full border-gray-300 rounded-none border-b-2 p-3 focus:border-black focus:ring-0 focus:outline-none transition">
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="submit" class="bg-black text-white px-8 py-3 uppercase tracking-widest font-bold hover:bg-red-600 transition">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
