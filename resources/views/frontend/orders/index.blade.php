@extends('frontend.account.layout')

@section('page-title', 'My Orders')

@section('account-content')
    @if($orders->count() > 0)
        <!-- Orders Grid -->
        <div style="display:flex;flex-direction:column;gap:24px;">
            @foreach($orders as $order)
            <div style="background:white;border:1px solid var(--gray-100);border-radius:var(--radius-3xl);padding:40px;transition:var(--trans-base);" class="fm-card-hover group">
                <div style="display:flex;flex-wrap:wrap;align-items:start;justify-content:space-between;gap:24px;margin-bottom:32px;">
                    <!-- Order Info -->
                    <div style="flex:1;min-width:200px;">
                        <div style="display:flex;flex-wrap:wrap;align-items:center;gap:16px;margin-bottom:24px;">
                            <h3 style="font-size:0.7rem;font-weight:900;text-transform:uppercase;letter-spacing:0.15em;color:var(--gray-400);">Order ID</h3>
                            <span style="font-size:1rem;font-weight:900;color:black;text-transform:uppercase;letter-spacing:0.05em;">#{{ strtoupper(substr($order->uuid, 0, 8)) }}</span>

                            @php
                                $statusColors = [
                                    'pending' => 'background:#fffbeb;color:#d97706;border-color:#fef3c7',
                                    'processing' => 'background:#eff6ff;color:#2563eb;border-color:#dbeafe',
                                    'delivered' => 'background:#f0fdf4;color:#16a34a;border-color:#dcfce7',
                                    'cancelled' => 'background:#fef2f2;color:#dc2626;border-color:#fee2e2',
                                ];
                                $statusStyle = $statusColors[$order->status] ?? 'background:var(--gray-50);color:var(--gray-600);border-color:var(--gray-100)';
                            @endphp

                            <span style="padding:6px 16px;border-radius:var(--radius-full);font-size:0.55rem;font-weight:900;text-transform:uppercase;letter-spacing:0.1em;border:1px solid;{{ $statusStyle }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>

                        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(120px, 1fr));gap:24px;">
                            <div>
                                <p style="font-size:0.6rem;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-400);margin-bottom:8px;">Order Date</p>
                                <p style="font-size:0.85rem;font-weight:900;color:black;">{{ $order->created_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p style="font-size:0.6rem;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-400);margin-bottom:8px;">Payment Method</p>
                                <p style="font-size:0.85rem;font-weight:900;color:black;text-transform:uppercase;">{{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Online Payment' }}</p>
                            </div>
                            <div>
                                <p style="font-size:0.6rem;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-400);margin-bottom:8px;">Payment Status</p>
                                <p style="font-size:0.85rem;font-weight:900;color:{{ $order->payment_status === 'paid' ? 'var(--primary)' : 'var(--secondary)' }};text-transform:uppercase;">
                                    {{ ucfirst($order->payment_status) }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Order Total & Action -->
                    <div style="display:flex;flex-direction:column;align-items:flex-end;gap:16px;min-width:150px;padding-left:40px;border-left:1px solid var(--gray-100);">
                        <div style="text-align:right;">
                            <p style="font-size:0.6rem;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-400);margin-bottom:8px;">Order Total</p>
                            <p style="font-size:1.8rem;font-weight:900;color:black;letter-spacing:-0.03em;">${{ number_format($order->total_amount, 2) }}</p>
                        </div>
                        <a href="{{ route('my-orders.show', $order->uuid) }}" class="fm-btn-vibrant" style="padding:12px 24px;font-size:0.65rem;border-radius:var(--radius-xl);">
                            <span>View Details</span>
                            <i class="fas fa-arrow-right" style="font-size:0.6rem;margin-left:8px;"></i>
                        </a>
                    </div>
                </div>

                <!-- Order Items Preview -->
                <div style="padding-top:32px;border-top:1px solid var(--gray-100);">
                    <p style="font-size:0.6rem;font-weight:900;text-transform:uppercase;letter-spacing:0.2em;color:var(--gray-400);margin-bottom:16px;">Items ({{ $order->orderItems->count() }})</p>
                    <div style="display:flex;flex-wrap:wrap;gap:16px;">
                        @foreach($order->orderItems->take(6) as $item)
                            <div style="width:64px;height:64px;background:var(--gray-50);border-radius:var(--radius-xl);overflow:hidden;border:1px solid var(--gray-100);">
                                @if($item->variant && $item->variant->product)
                                    <img src="{{ $item->variant->product->avatar_url }}" alt="{{ $item->variant->product->title }}" style="width:100%;height:100%;object-fit:cover;">
                                @elseif($item->product)
                                    <img src="{{ $item->product->avatar_url }}" alt="{{ $item->product->title }}" style="width:100%;height:100%;object-fit:cover;">
                                @else
                                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:var(--gray-300);">
                                        <i class="fas fa-box" style="font-size:1rem;"></i>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        @if($order->orderItems->count() > 6)
                            <div style="width:64px;height:64px;background:var(--gray-50);border-radius:var(--radius-xl);display:flex;align-items:center;justify-content:center;border:1px solid var(--gray-100);">
                                <span style="font-size:0.75rem;font-weight:900;color:var(--gray-400);">+{{ $order->orderItems->count() - 6 }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($orders->count() > 10)
        <div style="margin-top:48px;">
            {{ $orders->links() }}
        </div>
        @endif

    @else
        <!-- Empty State -->
        <div style="background:white;border:1px solid var(--gray-100);border-radius:var(--radius-3xl);padding:64px;text-align:center;">
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
