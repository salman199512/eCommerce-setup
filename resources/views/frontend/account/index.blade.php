@extends('frontend.account.layout')

@section('page-title', 'Dashboard')

@section('account-content')

<!-- Dashboard Overview -->
<div class="bg-white border-light rounded-xl p-24 mb-32" style="padding:40px;">
    <h2 style="font-size:0.7rem;font-weight:900;text-transform:uppercase;letter-spacing:0.15em;color:var(--gray-400);margin-bottom:32px;padding-bottom:16px;border-bottom:1px solid var(--gray-100);">Overview</h2>
    <div class="grid-3 gap-24">
        <div style="background:linear-gradient(135deg, var(--gray-50), white);padding:32px;border-radius:var(--radius-2xl);border:1px solid var(--gray-100);text-align:center;transition:var(--trans-base);" class="fm-card-hover">
            <div style="width:64px;height:64px;background:var(--green-dark);border-radius:var(--radius-xl);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;box-shadow:var(--shadow-sm);">
                <i class="fas fa-shopping-basket" style="color:white;font-size:1.5rem;"></i>
            </div>
            <h4 style="font-size:0.6rem;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-400);margin-bottom:12px;">Total Orders</h4>
            <p style="font-size:3rem;font-weight:900;color:black;letter-spacing:-0.05em;">{{ $orders->count() }}</p>
        </div>
        <div style="background:linear-gradient(135deg, var(--orange-soft), white);padding:32px;border-radius:var(--radius-2xl);border:1px solid var(--orange-light);text-align:center;transition:var(--trans-base);" class="fm-card-hover">
            <div style="width:64px;height:64px;background:var(--orange-primary);border-radius:var(--radius-xl);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;box-shadow:var(--shadow-sm);">
                <i class="fas fa-clock" style="color:white;font-size:1.5rem;"></i>
            </div>
            <h4 style="font-size:0.6rem;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-400);margin-bottom:12px;">Pending</h4>
            <p style="font-size:3rem;font-weight:900;color:var(--orange-primary);letter-spacing:-0.05em;">{{ $orders->where('status', 'pending')->count() }}</p>
        </div>
        <div style="background:linear-gradient(135deg, var(--green-soft), white);padding:32px;border-radius:var(--radius-2xl);border:1px solid var(--green-light);text-align:center;transition:var(--trans-base);" class="fm-card-hover">
            <div style="width:64px;height:64px;background:var(--green-primary);border-radius:var(--radius-xl);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;box-shadow:var(--shadow-sm);">
                <i class="fas fa-check-circle" style="color:white;font-size:1.5rem;"></i>
            </div>
            <h4 style="font-size:0.6rem;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-400);margin-bottom:12px;">Completed</h4>
            <p style="font-size:3rem;font-weight:900;color:var(--green-primary);letter-spacing:-0.05em;">{{ $orders->where('status', 'delivered')->count() }}</p>
        </div>
    </div>
</div>

<!-- Recent Orders -->
@if($orders->count() > 0)
<div class="bg-white border-light rounded-xl p-24" style="padding:40px;">
    <div class="flex items-center justify-between mb-32 pb-16 border-b border-gray-50" style="padding-bottom:16px;margin-bottom:32px;">
        <h2 style="font-size:0.7rem;font-weight:900;text-transform:uppercase;letter-spacing:0.15em;color:var(--gray-400);">Recent Orders</h2>
        <a href="{{ route('my-orders') }}" style="font-size:0.65rem;font-weight:900;text-transform:uppercase;letter-spacing:0.15em;color:var(--green-primary);text-decoration:none;transition:var(--trans-base);">View All →</a>
    </div>
    <div class="flex flex-col gap-16">
        @foreach($orders->take(5) as $order)
        <div class="bg-gray-50 border-light rounded-xl p-24 flex items-center justify-between transition-all fm-card-hover group" style="padding:24px;">
            <div style="flex:1;">
                <div class="flex items-center gap-16 mb-12">
                    <span style="font-size:0.85rem;font-weight:900;color:black;text-transform:uppercase;letter-spacing:0.05em;">#{{ strtoupper(substr($order->uuid, 0, 8)) }}</span>
                    @php
                        $statusColors = [
                            'pending' => 'background:var(--orange-soft);color:var(--orange-primary);border-color:var(--orange-light)',
                            'processing' => 'background:var(--purple-soft);color:var(--purple-primary);border-color:var(--purple-soft)',
                            'delivered' => 'background:var(--green-soft);color:var(--green-primary);border-color:var(--green-light)',
                            'cancelled' => 'background:var(--red-soft);color:var(--red-primary);border-color:var(--red-soft)',
                        ];
                        $statusStyle = $statusColors[$order->status] ?? 'background:var(--gray-50);color:var(--gray-600);border-color:var(--gray-100)';
                    @endphp
                    <span class="order-status" style="{{ $statusStyle }};padding:4px 12px;font-size:0.55rem;border:1px solid;">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                <p style="font-size:0.65rem;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;color:var(--gray-400);">{{ $order->created_at->format('M d, Y') }} • {{ $order->orderItems->count() }} Items</p>
            </div>
            <div class="flex items-center gap-24">
                <div style="text-align:right;">
                    <p style="font-size:1.5rem;font-weight:900;color:black;letter-spacing:-0.03em;">${{ number_format($order->total_amount, 2) }}</p>
                </div>
                <a href="{{ route('my-orders.show', $order->uuid) }}" class="fm-btn-vibrant" style="padding:10px 20px;font-size:0.6rem;">
                    View
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
<!-- Empty State -->
<div class="bg-white border-light rounded-xl p-24 text-center" style="padding:80px 40px;">
    <div style="width:96px;height:96px;background:var(--gray-50);border-radius:var(--radius-full);display:flex;align-items:center;justify-content:center;margin:0 auto 32px;">
        <i class="fas fa-shopping-basket" style="font-size:2.5rem;color:var(--gray-300);"></i>
    </div>
    <h2 style="font-size:2rem;font-weight:900;margin-bottom:16px;text-transform:uppercase;letter-spacing:-0.02em;">No Orders Yet</h2>
    <p style="color:var(--gray-500);margin-bottom:32px;font-size:0.9rem;font-weight:500;max-width:400px;margin-left:auto;margin-right:auto;line-height:1.6;">
        You haven't placed any orders yet. Start shopping to see your order history here.
    </p>
    <a href="{{ route('products') }}" class="fm-btn-vibrant" style="display:inline-flex;align-items:center;gap:12px;padding:20px 40px;font-size:0.75rem;">
        <i class="fas fa-arrow-left" style="font-size:0.7rem;"></i>
        <span>Continue Shopping</span>
    </a>
</div>
@endif

@endsection


