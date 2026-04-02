@extends('frontend.account.layout')

@section('page-title', 'Order #' . strtoupper(substr($order->uuid, 0, 8)))

@section('account-content')

<!-- Back Link -->
<a href="{{ route('my-orders') }}" class="order-back-link" style="color:var(--gray-500);margin-bottom:24px;display:inline-flex;">
    <i class="fas fa-arrow-left" style="font-size:0.6rem;"></i> Back to Orders
</a>

<!-- Order Status Header -->
<div style="background:white;border:1px solid var(--border-light);border-radius:var(--radius-2xl);padding:28px 32px;margin-bottom:24px;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:16px;box-shadow:var(--shadow-sm);">
    <div>
        <div style="font-size:0.62rem;font-weight:800;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-400);margin-bottom:6px;">Order ID</div>
        <div style="font-size:1.4rem;font-weight:900;color:var(--gray-900);letter-spacing:-0.02em;">#{{ strtoupper(substr($order->uuid, 0, 8)) }}</div>
        <div style="font-size:0.72rem;color:var(--gray-400);font-weight:600;margin-top:4px;">Placed on {{ $order->created_at->format('F d, Y') }}</div>
    </div>
    <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
        @php
            $statusMap = [
                'pending'    => ['bg'=>'var(--yellow-soft)',  'color'=>'var(--yellow-primary)',  'icon'=>'fa-clock'],
                'processing' => ['bg'=>'#eff6ff',             'color'=>'#2563eb',                'icon'=>'fa-gear'],
                'shipped'    => ['bg'=>'var(--teal-soft)',    'color'=>'var(--teal-primary)',    'icon'=>'fa-truck'],
                'delivered'  => ['bg'=>'var(--primary-soft)',   'color'=>'var(--primary)',   'icon'=>'fa-circle-check'],
                'cancelled'  => ['bg'=>'var(--red-soft)',     'color'=>'var(--red-primary)',     'icon'=>'fa-circle-xmark'],
            ];
            $s = $statusMap[$order->status] ?? ['bg'=>'var(--gray-50)','color'=>'var(--gray-500)','icon'=>'fa-circle'];
        @endphp
        <span style="display:inline-flex;align-items:center;gap:8px;padding:8px 18px;border-radius:var(--radius-full);font-size:0.68rem;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;background:{{ $s['bg'] }};color:{{ $s['color'] }};">
            <i class="fas {{ $s['icon'] }}"></i> {{ ucfirst($order->status) }}
        </span>
        <span style="display:inline-flex;align-items:center;gap:6px;padding:8px 14px;border-radius:var(--radius-full);font-size:0.68rem;font-weight:800;background:{{ $order->payment_status === 'paid' ? 'var(--primary-soft)' : 'var(--secondary-soft)' }};color:{{ $order->payment_status === 'paid' ? 'var(--primary)' : 'var(--secondary)' }};">
            <i class="fas {{ $order->payment_status === 'paid' ? 'fa-lock' : 'fa-clock' }}"></i>
            {{ ucfirst($order->payment_status) }}
        </span>
    </div>
</div>

<!-- Content Grid -->
<div style="display:grid;grid-template-columns:1fr 320px;gap:24px;align-items:start;">

    <!-- Left: Items + Shipping -->
    <div style="display:flex;flex-direction:column;gap:20px;">

        <!-- Order Items -->
        <div style="background:white;border:1px solid var(--border-light);border-radius:var(--radius-2xl);padding:28px;box-shadow:var(--shadow-sm);">
            <div style="font-size:0.62rem;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-400);margin-bottom:20px;padding-bottom:14px;border-bottom:1px solid var(--gray-100);">
                Order Items ({{ $order->orderItems->count() }})
            </div>
            <div style="display:flex;flex-direction:column;gap:0;">
                @foreach($order->orderItems as $item)
                <div style="display:flex;gap:16px;padding:16px 0;border-bottom:1px solid var(--gray-50);" class="last:border-0 last:pb-0">
                    <!-- Image -->
                    <div style="width:72px;height:72px;background:var(--gray-50);border-radius:var(--radius-md);overflow:hidden;flex-shrink:0;border:1px solid var(--gray-100);">
                        @if($item->variant && $item->variant->product)
                            <img src="{{ $item->variant->product->avatar_url }}" alt="{{ $item->variant->product->title }}" style="width:100%;height:100%;object-fit:cover;">
                        @elseif($item->product)
                            <img src="{{ $item->product->avatar_url }}" alt="{{ $item->product->title }}" style="width:100%;height:100%;object-fit:cover;">
                        @else
                            <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:var(--gray-300);"><i class="fas fa-image"></i></div>
                        @endif
                    </div>
                    <!-- Info -->
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:0.85rem;font-weight:800;color:var(--gray-900);margin-bottom:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                            @if($item->variant && $item->variant->product) {{ $item->variant->product->title }}
                            @elseif($item->product) {{ $item->product->title }}
                            @else Product @endif
                        </div>
                        @if($item->variant && $item->variant->attributes && $item->variant->attributes->isNotEmpty())
                        <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:6px;">
                            @foreach($item->variant->attributes as $attr)
                            <span style="font-size:0.58rem;font-weight:800;text-transform:uppercase;letter-spacing:0.08em;color:var(--gray-500);background:var(--gray-100);padding:3px 10px;border-radius:var(--radius-full);">
                                {{ $attr->attributeGroup->title }}: {{ $attr->title }}
                            </span>
                            @endforeach
                        </div>
                        @endif
                        <div style="font-size:0.68rem;font-weight:700;color:var(--gray-400);">
                            Qty: <span style="color:var(--gray-900);font-weight:800;">{{ $item->quantity }}</span>
                            &nbsp;·&nbsp; Price: <span style="color:var(--gray-900);font-weight:800;">₹{{ number_format($item->price, 2) }}</span>
                        </div>
                    </div>
                    <!-- Total -->
                    <div style="font-size:1rem;font-weight:900;color:var(--gray-900);flex-shrink:0;">
                        ₹{{ number_format($item->quantity * $item->price, 2) }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Shipping Address -->
        <div style="background:white;border:1px solid var(--border-light);border-radius:var(--radius-2xl);padding:28px;box-shadow:var(--shadow-sm);">
            <div style="font-size:0.62rem;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-400);margin-bottom:20px;padding-bottom:14px;border-bottom:1px solid var(--gray-100);">
                <i class="fas fa-location-dot" style="color:var(--primary);margin-right:6px;"></i> Shipping Address
            </div>
            <div style="background:var(--gray-50);padding:20px 24px;border-radius:var(--radius-lg);border:1px solid var(--gray-100);">
                @if($order->address)
                    <div style="font-size:0.9rem;font-weight:800;color:var(--gray-900);margin-bottom:8px;">{{ $order->first_name }} {{ $order->last_name }}</div>
                    <div style="font-size:0.85rem;color:var(--gray-600);line-height:1.7;">
                        {{ $order->address }}<br>
                        @if($order->city){{ $order->city }}, @endif
                        @if($order->state){{ $order->state }} @endif
                        @if($order->zip_code){{ $order->zip_code }}@endif
                    </div>
                    @if($order->phone)
                    <div style="font-size:0.8rem;color:var(--gray-500);margin-top:10px;">
                        <i class="fas fa-phone" style="color:var(--primary);margin-right:5px;font-size:0.7rem;"></i>
                        {{ $order->phone }}
                    </div>
                    @endif
                @else
                    <div style="font-size:0.9rem;font-weight:800;color:var(--gray-900);margin-bottom:8px;">{{ $order->user->name }}</div>
                    <div style="font-size:0.82rem;color:var(--gray-500);font-style:italic;">Shipping address not specified</div>
                @endif
            </div>
        </div>

    </div>

    <!-- Right: Order Summary -->
    <div style="background:white;border:1px solid var(--border-light);border-radius:var(--radius-2xl);padding:28px;position:sticky;top:100px;box-shadow:var(--shadow-md);">
        <div style="font-size:0.62rem;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-400);margin-bottom:20px;padding-bottom:14px;border-bottom:1px solid var(--gray-100);">Order Summary</div>

        <div style="display:flex;flex-direction:column;gap:12px;margin-bottom:16px;">
            <div style="display:flex;justify-content:space-between;font-size:0.78rem;font-weight:600;color:var(--gray-500);">
                <span>Subtotal</span>
                <span style="color:var(--gray-900);font-weight:700;">₹{{ number_format($order->subtotal ?? 0, 2) }}</span>
            </div>
            @if(isset($order->tax_amount) && $order->tax_amount > 0)
            <div style="display:flex;justify-content:space-between;font-size:0.78rem;font-weight:600;color:var(--gray-500);">
                <span>Tax</span><span style="color:var(--gray-900);font-weight:700;">₹{{ number_format($order->tax_amount, 2) }}</span>
            </div>
            @endif
            @if(isset($order->shipping_amount) && $order->shipping_amount > 0)
            <div style="display:flex;justify-content:space-between;font-size:0.78rem;font-weight:600;color:var(--gray-500);">
                <span>Shipping</span><span style="color:var(--gray-900);font-weight:700;">₹{{ number_format($order->shipping_amount, 2) }}</span>
            </div>
            @elseif(isset($order->shipping_amount))
            <div style="display:flex;justify-content:space-between;font-size:0.78rem;font-weight:600;color:var(--gray-500);">
                <span>Shipping</span><span style="color:var(--primary);font-weight:800;">Free</span>
            </div>
            @endif
            @if(isset($order->discount_amount) && $order->discount_amount > 0)
            <div style="display:flex;justify-content:space-between;font-size:0.78rem;font-weight:600;color:var(--red-primary);">
                <span>Discount</span><span style="font-weight:700;">-₹{{ number_format($order->discount_amount, 2) }}</span>
            </div>
            @endif
        </div>

        <div style="padding:16px 0;border-top:2px solid var(--gray-100);border-bottom:1px solid var(--gray-100);margin-bottom:20px;display:flex;justify-content:space-between;align-items:center;">
            <span style="font-size:0.82rem;font-weight:900;text-transform:uppercase;letter-spacing:0.08em;color:var(--gray-900);">Total</span>
            <span style="font-size:1.6rem;font-weight:900;color:var(--primary);letter-spacing:-0.03em;">₹{{ number_format($order->total_amount, 2) }}</span>
        </div>

        <!-- Payment Info -->
        <div style="display:flex;flex-direction:column;gap:14px;">
            <div>
                <div style="font-size:0.58rem;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-300);margin-bottom:5px;">Payment Method</div>
                <div style="font-size:0.82rem;font-weight:800;color:var(--gray-900);display:flex;align-items:center;gap:8px;">
                    <i class="fas {{ $order->payment_method === 'cod' ? 'fa-money-bill-wave' : 'fa-credit-card' }}" style="color:var(--primary);font-size:0.85rem;"></i>
                    {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Online Payment' }}
                </div>
            </div>
            @if($order->transaction_id)
            <div>
                <div style="font-size:0.58rem;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-300);margin-bottom:5px;">Transaction ID</div>
                <div style="font-size:0.72rem;font-weight:700;color:var(--gray-600);word-break:break-all;">{{ $order->transaction_id }}</div>
            </div>
            @endif
        </div>

        <div style="margin-top:24px;">
            <a href="{{ route('my-orders') }}" class="fm-btn-vibrant" style="display:flex;justify-content:center;align-items:center;gap:8px;width:100%;padding:14px;font-size:0.72rem;text-decoration:none;">
                <i class="fas fa-arrow-left" style="font-size:0.65rem;"></i> Back to Orders
            </a>
        </div>
    </div>

</div>

@endsection

@push('styles')
<style>
@media (max-width: 900px) {
    .order-detail-grid { grid-template-columns: 1fr !important; }
}
</style>
@endpush
