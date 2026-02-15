@extends('frontend.account.layout')

@section('page-title', 'My Orders')

@section('account-content')
        @if($orders->count() > 0)
            <!-- Orders Grid -->
            <div class="space-y-6">
                @foreach($orders as $order)
                <div class="bg-white border border-gray-100 rounded-3xl p-8 md:p-10 hover:shadow-2xl hover:shadow-black/5 transition-all duration-500 group">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-8">
                        <!-- Order Info -->
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-4 mb-4">
                                <h3 class="text-[11px] font-black uppercase tracking-widest text-gray-400">Order ID</h3>
                                <span class="text-base font-black text-black uppercase tracking-wider">#{{ strtoupper(substr($order->uuid, 0, 8)) }}</span>
                                
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
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Order Date</p>
                                    <p class="text-sm font-black text-black">{{ $order->created_at->format('M d, Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Payment Method</p>
                                    <p class="text-sm font-black text-black uppercase">{{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Online Payment' }}</p>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Payment Status</p>
                                    <p class="text-sm font-black {{ $order->payment_status === 'paid' ? 'text-emerald-600' : 'text-yellow-600' }} uppercase">
                                        {{ ucfirst($order->payment_status) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Order Total & Action -->
                        <div class="flex flex-col items-end gap-4 lg:border-l lg:border-gray-100 lg:pl-10">
                            <div class="text-right">
                                <p class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Order Total</p>
                                <p class="text-3xl font-black text-black tracking-tighter">${{ number_format($order->total_amount, 2) }}</p>
                            </div>
                            <a href="{{ route('my-orders.show', $order->uuid) }}" 
                               class="inline-flex items-center gap-3 bg-black text-white px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-600 transition-all duration-500 shadow-xl shadow-black/10 group-hover:shadow-2xl group-hover:shadow-black/20">
                                <span>View Details</span>
                                <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Order Items Preview -->
                    <div class="pt-8 border-t border-gray-100">
                        <p class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400 mb-4">Items ({{ $order->orderItems->count() }})</p>
                        <div class="flex flex-wrap gap-4">
                            @foreach($order->orderItems->take(4) as $item)
                                <div class="w-16 h-16 bg-gray-50 rounded-xl overflow-hidden border border-gray-100">
                                    @if($item->variant && $item->variant->product)
                                        <img src="{{ $item->variant->product->avatar_url }}" alt="{{ $item->variant->product->title }}" class="w-full h-full object-cover">
                                    @elseif($item->product)
                                        <img src="{{ $item->product->avatar_url }}" alt="{{ $item->product->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                                            <i class="fas fa-box text-sm"></i>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            @if($order->orderItems->count() > 4)
                                <div class="w-16 h-16 bg-gray-50 rounded-xl flex items-center justify-center border border-gray-100">
                                    <span class="text-[10px] font-black text-gray-400">+{{ $order->orderItems->count() - 4 }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($orders->hasPages())
            <div class="mt-12">
                {{ $orders->links() }}
            </div>
            @endif
            
        @else
            <!-- Empty State -->
            <div class="text-center py-24">
                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-8">
                    <i class="fas fa-shopping-bag text-3xl text-gray-300"></i>
                </div>
                <h2 class="text-3xl font-black mb-4 tracking-tight uppercase">No Orders Yet</h2>
                <p class="text-gray-500 mb-8 text-sm font-medium max-w-md mx-auto">
                    You haven't placed any orders yet. Start shopping to see your order history here.
                </p>
                <a href="{{ route('products') }}" 
                   class="inline-flex items-center gap-3 bg-black text-white px-10 py-5 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-red-600 transition-all duration-500 shadow-xl shadow-black/10">
                    <i class="fas fa-arrow-left text-xs"></i>
                    <span>Continue Shopping</span>
                </a>
            </div>
        @endif>
@endsection
