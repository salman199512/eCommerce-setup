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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Profile Info</h3>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ $customer->avatarUrl['250'] }}" class="img-circle elevation-2 mb-3" style="width: 150px;" alt="User Image">
                            <h4 class="mb-0">{{ $customer->name }}</h4>
                            <p class="text-muted">{{ $customer->email }}</p>
                            <hr>
                            <div class="text-left">
                                <strong><i class="fas fa-phone mr-1"></i> Mobile</strong>
                                <p class="text-muted">{{ $customer->mobile ?? 'N/A' }}</p>
                                <strong><i class="fas fa-calendar-alt mr-1"></i> Registered On</strong>
                                <p class="text-muted">{{ $customer->created_at->format('d M, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order History -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order History</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($customer->orders as $order)
                                            <tr>
                                                <td>#{{ $order->id }}</td>
                                                <td>{{ $order->created_at->format('d M, Y') }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $order->status == 'delivered' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }}">
                                                        {{ strtoupper($order->status) }}
                                                    </span>
                                                </td>
                                                <td>₹{{ number_format($order->total_amount, 2) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.orders.show', $order->uuid) }}" class="btn btn-default btn-xs">View</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No orders found for this customer.</td>
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
