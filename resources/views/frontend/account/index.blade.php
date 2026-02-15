@extends('frontend.account.layout')

@section('page-title', 'Dashboard')

@section('account-content')

<!-- Dashboard Overview -->
<div class="bg-white border border-gray-100 rounded-3xl p-8 md:p-10 mb-8">
    <h2 class="text-[11px] font-black uppercase tracking-widest text-gray-400 mb-8 pb-4 border-b border-gray-100">Overview</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gradient-to-br from-gray-50 to-white p-8 rounded-2xl border border-gray-100 text-center hover:shadow-xl hover:shadow-black/5 transition-all duration-500">
            <div class="w-16 h-16 bg-black rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-shopping-bag text-white text-2xl"></i>
            </div>
            <h4 class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400 mb-3">Total Orders</h4>
            <p class="text-5xl font-black text-black tracking-tighter">{{ $orders->count() }}</p>
        </div>
        <div class="bg-gradient-to-br from-yellow-50 to-white p-8 rounded-2xl border border-yellow-100 text-center hover:shadow-xl hover:shadow-yellow-500/10 transition-all duration-500">
            <div class="w-16 h-16 bg-yellow-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-clock text-white text-2xl"></i>
            </div>
            <h4 class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400 mb-3">Pending</h4>
            <p class="text-5xl font-black text-yellow-600 tracking-tighter">{{ $orders->where('status', 'pending')->count() }}</p>
        </div>
        <div class="bg-gradient-to-br from-emerald-50 to-white p-8 rounded-2xl border border-emerald-100 text-center hover:shadow-xl hover:shadow-emerald-500/10 transition-all duration-500">
            <div class="w-16 h-16 bg-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-check-circle text-white text-2xl"></i>
            </div>
            <h4 class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400 mb-3">Completed</h4>
            <p class="text-5xl font-black text-emerald-600 tracking-tighter">{{ $orders->where('status', 'delivered')->count() }}</p>
        </div>
    </div>
</div>

<!-- Recent Orders -->
@if($orders->count() > 0)
<div class="bg-white border border-gray-100 rounded-3xl p-8 md:p-10">
    <div class="flex items-center justify-between mb-8 pb-4 border-b border-gray-100">
        <h2 class="text-[11px] font-black uppercase tracking-widest text-gray-400">Recent Orders</h2>
        <a href="{{ route('my-orders') }}" class="text-[10px] font-black uppercase tracking-widest text-red-600 hover:text-black transition">View All →</a>
    </div>
    <div class="space-y-4">
        @foreach($orders->take(5) as $order)
        <div class="flex items-center justify-between p-6 bg-gray-50/50 rounded-2xl border border-gray-100 hover:shadow-lg hover:shadow-black/5 transition-all duration-500 group">
            <div class="flex-1">
                <div class="flex items-center gap-4 mb-3">
                    <span class="text-sm font-black text-black uppercase tracking-wider">#{{ strtoupper(substr($order->uuid, 0, 8)) }}</span>
                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-50 text-yellow-600 border-yellow-100',
                            'processing' => 'bg-blue-50 text-blue-600 border-blue-100',
                            'completed' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                            'cancelled' => 'bg-red-50 text-red-600 border-red-100',
                        ];
                        $statusClass = $statusColors[$order->status] ?? 'bg-gray-50 text-gray-600 border-gray-100';
                    @endphp
                    <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest border {{ $statusClass }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">{{ $order->created_at->format('M d, Y') }} • {{ $order->orderItems->count() }} Items</p>
            </div>
            <div class="flex items-center gap-6">
                <div class="text-right">
                    <p class="text-2xl font-black text-black tracking-tighter">${{ number_format($order->total_amount, 2) }}</p>
                </div>
                <a href="{{ route('my-orders.show', $order->uuid) }}" class="px-6 py-3 bg-black text-white rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-red-600 transition-all duration-500 opacity-0 group-hover:opacity-100">
                    View
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
<!-- Empty State -->
<div class="bg-white border border-gray-100 rounded-3xl p-16 text-center">
    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-8">
        <i class="fas fa-shopping-bag text-4xl text-gray-300"></i>
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
@endif

@endsection
