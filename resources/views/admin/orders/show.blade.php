@extends('admin.layouts.master')

@section('title')
    Order Details #{{ $order->order_number }} - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Order Details #{{ $order->order_number }}</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
    <li class="breadcrumb-item active">Details</li>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Main Details -->
            <div class="col-md-9">
                <div class="card card-outline card-primary shadow-sm border-0">
                    <div class="card-header bg-transparent border-bottom">
                        <h3 class="card-title fw-bold text-primary">
                            <i class="fa-duotone fa-boxes-stacked me-2"></i> Order Items
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Product</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end pe-4">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderItems as $item)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $item->product ? $item->product->avatar_url : 'https://via.placeholder.com/50' }}" class="img-thumbnail me-3" width="50">
                                                <span class="fw-semibold text-dark">{{ $item->product ? $item->product->title : 'Removed Product' }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center text-muted">₹{{ number_format($item->price, 2) }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-light text-dark border">{{ $item->quantity }}</span>
                                        </td>
                                        <td class="text-end pe-4 fw-bold">₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <th colspan="3" class="text-end py-3 ps-4">Grand Total</th>
                                        <th class="text-end py-3 pe-4 text-primary fs-5 fw-bold">₹{{ number_format($order->total_amount, 2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card card-outline card-info shadow-sm border-0 mt-4">
                    <div class="card-header bg-transparent border-bottom">
                        <h3 class="card-title fw-bold text-info">
                            <i class="fa-duotone fa-location-dot me-2"></i> Shipping & Billing Details
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-sm-6 border-end">
                                <h6 class="text-muted text-uppercase small fw-bold mb-3">Customer Information</h6>
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex justify-content-between">
                                        <span class="text-secondary">Name:</span>
                                        <span class="text-dark fw-semibold text-end">{{ $order->first_name }} {{ $order->last_name }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-secondary">Email:</span>
                                        <span class="text-dark text-end">{{ $order->email }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-secondary">Phone:</span>
                                        <span class="text-dark text-end">{{ $order->phone }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h6 class="text-muted text-uppercase small fw-bold mb-3">Delivery Address</h6>
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex justify-content-between">
                                        <span class="text-secondary">Address:</span>
                                        <span class="text-dark text-end ms-3">{{ $order->address }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-secondary">Location:</span>
                                        <span class="text-dark text-end">{{ $order->city }}, {{ $order->state }} {{ $order->zip_code }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Actions -->
            <div class="col-md-3">
                <div class="card card-outline card-secondary shadow-sm border-0 sticky-top" style="top: 20px; z-index: 10;">
                    <div class="card-header bg-transparent border-bottom">
                        <h3 class="card-title fw-bold text-secondary">
                            <i class="fa-duotone fa-circle-info me-2"></i> Order Summary
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column gap-3 mb-4">
                            <div class="d-flex justify-content-between align-items-center pb-2 border-bottom">
                                <span class="text-secondary small">Status</span>
                                <div class="w-50">
                                    <select id="order-status-select" class="form-select form-select-sm border-secondary-subtle">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-secondary small">Payment</span>
                                <span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-danger' }} rounded-pill px-3 shadow-sm">
                                    {{ strtoupper($order->payment_status) }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center py-2 border-top border-bottom">
                                <span class="text-secondary small">Transaction ID</span>
                                <span class="text-dark small fw-bold text-truncate ms-2" title="{{ $order->transaction_id }}">
                                    {{ $order->transaction_id ?: 'N/A' }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-secondary small">Order Date</span>
                                <span class="text-dark small fw-medium">
                                    {{ $order->created_at->format('M d, Y H:i') }}
                                </span>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button id="update-status-btn" class="btn btn-primary shadow-sm py-2">
                                <i class="fa-duotone fa-check-circle me-2"></i> Update Status
                            </button>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-danger py-2">
                                <i class="fa-duotone fa-arrow-left me-2"></i> Back to Orders
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('stackedScripts')
<style>
    .card-outline.card-primary { border-top: 3px solid var(--bs-primary) !important; }
    .card-outline.card-info { border-top: 3px solid var(--bs-info) !important; }
    .card-outline.card-secondary { border-top: 3px solid var(--bs-secondary) !important; }
    .table > :not(caption) > * > * { padding: 1rem 0.5rem; }
    .form-select-sm { font-size: 0.8rem; padding: 0.25rem 0.5rem; }
</style>
<script>
    $('#update-status-btn').click(function() {
        const status = $('#order-status-select').val();
        const btn = $(this);
        btn.prop('disabled', true).html('<i class="fa-duotone fa-spinner fa-spin me-2"></i> Updating...');
        
        $.ajax({
            url: "{{ route('admin.orders.updateStatus', $order->id) }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function(response) {
                if(typeof toastr !== 'undefined') {
                    toastr.success(response.message);
                } else if(typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        customClass: { confirmButton: 'btn btn-success' }
                    });
                } else {
                    alert(response.message);
                }
                setTimeout(() => { window.location.reload(); }, 1000);
            },
            error: function() {
                if(typeof toastr !== 'undefined') {
                    toastr.error('Failed to update status');
                } else {
                    alert('Failed to update status');
                }
            },
            complete: function() {
                btn.prop('disabled', false).html('<i class="fa-duotone fa-check-circle me-2"></i> Update Status');
            }
        });
    });
</script>
@endpush
