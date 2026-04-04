@extends('admin.layouts.master')

@section('title')
    Customer Detail - {{ $customer->name }}
@endsection

@section('page_headers')
    <h4>Customer: {{ $customer->name }}</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Customers</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Customer Info -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow-sm border-0 border-top border-4 border-primary">
                        <div class="card-header bg-transparent border-bottom">
                            <h3 class="card-title fw-bold text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.832 2.849" /></svg>
                                Customer Information
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <div class="avatar-xl bg-primary-transparent text-primary rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: rgba(5, 122, 255, 0.1);">
                                    <span class="fs-1 fw-bold text-uppercase">{{ substr($customer->name, 0, 1) }}</span>
                                </div>
                                <h4 class="mt-3 mb-1 fw-bold">{{ $customer->name }}</h4>
                                <p class="text-muted small">{{ $customer->email }}</p>
                            </div>

                            <div class="list-group list-group-flush border-top">
                                <div class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone text-muted me-2" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                                        <span class="text-muted small">Mobile Number</span>
                                    </div>
                                    <span class="fw-semibold">{{ $customer->mobile ?? 'Not Provided' }}</span>
                                </div>
                                <div class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event text-muted me-2" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15l2 2l4 -4" /></svg>
                                        <span class="text-muted small">Customer Since</span>
                                    </div>
                                    <span class="fw-semibold">{{ $customer->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order History -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-transparent border-bottom">
                            <h3 class="card-title fw-bold text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                                Order History
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-4">Order ID</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                            <th class="text-end pe-4">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($customer->orders as $order)
                                            <tr>
                                                <td class="ps-4 fw-bold">#{{ $order->id }}</td>
                                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    @php
                                                        $statusClass = [
                                                            'delivered' => 'bg-success-transparent text-success',
                                                            'pending' => 'bg-warning-transparent text-warning',
                                                            'processing' => 'bg-info-transparent text-info',
                                                            'shipped' => 'bg-primary-transparent text-primary',
                                                            'cancelled' => 'bg-danger-transparent text-danger',
                                                        ][$order->status] ?? 'bg-light text-dark';
                                                    @endphp
                                                    <span class="badge {{ $statusClass }} rounded-pill px-3 py-2 fw-semibold" style="background: rgba(var(--bs-{{ str_replace('-transparent', '', $statusClass) }}-rgb), 0.1);">
                                                        <i class="fas fa-circle me-1 small"></i> {{ strtoupper($order->status) }}
                                                    </span>
                                                </td>
                                                <td class="fw-bold">₹{{ number_format($order->total_amount, 2) }}</td>
                                                <td class="text-end pe-4">
                                                    <a href="{{ route('admin.orders.show', $order->uuid) }}" class="btn btn-sm btn-icon btn-primary-light" title="View Order">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-5 text-muted">No orders found for this customer.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
