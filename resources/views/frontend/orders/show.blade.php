@extends('frontend.layouts.master')

@section('meta_title', 'Order Details - #' . strtoupper(substr($order->uuid, 0, 8)))

@section('content')

<!-- Page Header -->
<div class="bg-white pt-24 pb-12 border-b border-gray-100">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <a href="{{ route('my-orders') }}" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-black transition mb-6">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Orders</span>
            </a>
            <span class="text-red-600 text-[12px] font-black uppercase tracking-[0.3em] mb-6 block">Order Details</span>
            <h1 class="text-4xl md:text-5xl font-black mb-6 leading-[0.9] tracking-[-0.04em] text-black uppercase">#{{ strtoupper(substr($order->uuid, 0, 8)) }}</h1>
            <div class="flex flex-wrap items-center gap-4">
                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-50 text-yellow-600 border-yellow-100',
                        'processing' => 'bg-blue-50 text-blue-600 border-blue-100',
                        'completed' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                        'cancelled' => 'bg-red-50 text-red-600 border-red-100',
                    ];
                    $statusClass = $statusColors[$order->status] ?? 'bg-gray-50 text-gray-600 border-gray-100';
                @endphp
                <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest border {{ $statusClass }}">
                    {{ ucfirst($order->status) }}
                </span>
                <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">
                    Placed on {{ $order->created_at->format('F d, Y') }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-16 md:py-24">
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Order Items -->
                <div class="bg-white border border-gray-100 rounded-3xl p-8 md:p-10">
                    <h2 class="text-[11px] font-black uppercase tracking-widest text-gray-400 mb-8 pb-4 border-b border-gray-100">Order Items</h2>
                    <div class="space-y-6">
                        @foreach($order->orderItems as $item)
                        <div class="flex gap-6 pb-6 border-b border-gray-50 last:border-0 last:pb-0">
                            <!-- Product Image -->
                            <div class="w-24 h-24 bg-gray-50 rounded-2xl overflow-hidden shrink-0 border border-gray-100">
                                @if($item->variant && $item->variant->product)
                                    <img src="{{ $item->variant->product->avatar_url }}" alt="{{ $item->variant->product->title }}" class="w-full h-full object-cover">
                                @elseif($item->product)
                                    <img src="{{ $item->product->avatar_url }}" alt="{{ $item->product->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <i class="fas fa-image text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Product Info -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-black text-black mb-2 uppercase tracking-wide truncate">
                                    @if($item->variant && $item->variant->product)
                                        {{ $item->variant->product->title }}
                                    @elseif($item->product)
                                        {{ $item->product->title }}
                                    @else
                                        Product
                                    @endif
                                </h3>
                                
                                <!-- Variant Attributes -->
                                @if($item->variant && $item->variant->attributes && $item->variant->attributes->isNotEmpty())
                                <div class="flex flex-wrap gap-2 mb-3">
                                    @foreach($item->variant->attributes as $attr)
                                    <span class="text-[9px] font-black uppercase tracking-widest text-gray-500 bg-gray-50 px-3 py-1 rounded-full">
                                        {{ $attr->attributeGroup->title }}: {{ $attr->title }}
                                    </span>
                                    @endforeach
                                </div>
                                @endif
                                
                                <div class="flex items-center gap-6 text-[10px] font-black uppercase tracking-widest text-gray-400">
                                    <span>Qty: <span class="text-black">{{ $item->quantity }}</span></span>
                                    <span>Price: <span class="text-black">${{ number_format($item->price, 2) }}</span></span>
                                </div>
                            </div>
                            
                            <!-- Item Total -->
                            <div class="text-right">
                                <p class="text-xl font-black text-black tracking-tighter">${{ number_format($item->quantity * $item->price, 2) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Shipping Address -->
                <div class="bg-white border border-gray-100 rounded-3xl p-8 md:p-10">
                    <h2 class="text-[11px] font-black uppercase tracking-widest text-gray-400 mb-6">Shipping Address</h2>
                    <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
                        @if($order->shipping_name || $order->shipping_address)
                            <p class="text-sm font-black text-black mb-2">{{ $order->shipping_name ?: $order->user->name }}</p>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                {{ $order->shipping_address }}<br>
                                @if($order->shipping_city){{ $order->shipping_city }}, @endif
                                @if($order->shipping_state){{ $order->shipping_state }} @endif
                                @if($order->shipping_zip){{ $order->shipping_zip }}<br>@endif
                                @if($order->shipping_country){{ $order->shipping_country }}@endif
                            </p>
                            @if($order->shipping_phone)
                            <p class="text-sm text-gray-600 mt-3">
                                <span class="font-black text-black">Phone:</span> {{ $order->shipping_phone }}
                            </p>
                            @endif
                            @if($order->shipping_email)
                            <p class="text-sm text-gray-600 mt-1">
                                <span class="font-black text-black">Email:</span> {{ $order->shipping_email }}
                            </p>
                            @endif
                        @else
                            <p class="text-sm font-black text-black mb-2">{{ $order->user->name }}</p>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                @if($order->user->email)
                                    <span class="font-black text-black">Email:</span> {{ $order->user->email }}<br>
                                @endif
                                @if($order->user->mobile)
                                    <span class="font-black text-black">Phone:</span> {{ $order->user->mobile }}
                                @endif
                            </p>
                            <p class="text-xs text-gray-400 mt-3 italic">Shipping address not specified</p>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Order Summary -->
                <div class="bg-white border border-gray-100 rounded-3xl p-8 sticky top-32">
                    <h2 class="text-[11px] font-black uppercase tracking-widest text-gray-400 mb-8 pb-4 border-b border-gray-100">Order Summary</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-500">Subtotal</span>
                            <span class="text-sm font-black text-black">${{ number_format($order->sub_total, 2) }}</span>
                        </div>
                        
                        @if($order->tax_amount > 0)
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-500">Tax</span>
                            <span class="text-sm font-black text-black">${{ number_format($order->tax_amount, 2) }}</span>
                        </div>
                        @endif
                        
                        @if($order->shipping_amount > 0)
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-500">Shipping</span>
                            <span class="text-sm font-black text-black">${{ number_format($order->shipping_amount, 2) }}</span>
                        </div>
                        @endif
                        
                        @if($order->discount_amount > 0)
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-black uppercase tracking-widest text-red-600">Discount</span>
                            <span class="text-sm font-black text-red-600">-${{ number_format($order->discount_amount, 2) }}</span>
                        </div>
                        @endif
                    </div>
                    
                    <div class="pt-6 border-t border-gray-100 mb-8">
                        <div class="flex justify-between items-center">
                            <span class="text-[11px] font-black uppercase tracking-widest text-black">Total</span>
                            <span class="text-2xl font-black text-black tracking-tighter">${{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                    
                    <!-- Payment Info -->
                    <div class="space-y-4 pt-6 border-t border-gray-100">
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Payment Method</p>
                            <p class="text-sm font-black text-black uppercase">
                                {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Online Payment' }}
                            </p>
                        </div>
                        
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Payment Status</p>
                            <p class="text-sm font-black {{ $order->payment_status === 'paid' ? 'text-emerald-600' : 'text-yellow-600' }} uppercase">
                                {{ ucfirst($order->payment_status) }}
                            </p>
                        </div>
                        
                        @if($order->transaction_id)
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Transaction ID</p>
                            <p class="text-xs font-black text-black break-all">{{ $order->transaction_id }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
