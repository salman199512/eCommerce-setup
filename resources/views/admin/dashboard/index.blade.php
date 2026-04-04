@extends('admin.layouts.master')

@section('title')
    Dashboard - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Dashboard Analytics</h4>
@endsection

@section('page_buttons')
    <div class="d-flex align-items-center">
        <div class="me-2 text-muted fw-semibold small">Filter by Year:</div>
        <form action="{{ route('dashboard') }}" method="GET" id="yearFilterForm" class="m-0">
            <select name="year" onchange="document.getElementById('yearFilterForm').submit()" class="form-select form-select-sm shadow-sm border-primary-light" style="width: 120px; border-radius: 8px;">
                @foreach($availableYears as $y)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endforeach
            </select>
        </form>
    </div>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-primary text-white mb-4 shadow" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; border: none;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-white-50 small">Total Revenue ({{ $year }})</div>
                                    <div class="fs-2 fw-bold">₹{{ number_format($totalRevenue, 2) }}</div>
                                </div>
                                <i class="fas fa-indian-rupee-sign fa-2x text-white-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-success text-white mb-4 shadow" style="background: linear-gradient(135deg, #3d9b06 0%, #a8e063 100%) !important; border: none;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-white-50 small">Total Orders ({{ $year }})</div>
                                    <div class="fs-2 fw-bold">{{ number_format($totalOrders) }}</div>
                                </div>
                                <i class="fas fa-shopping-cart fa-2x text-white-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-info text-white mb-4 shadow" style="background: linear-gradient(135deg, #2193b0 0%, #6dd5ed 100%) !important; border: none;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-white-50 small">Active Customers ({{ $year }})</div>
                                    <div class="fs-2 fw-bold">{{ number_format($activeCustomers) }}</div>
                                </div>
                                <i class="fas fa-users fa-2x text-white-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Sales Chart -->
                <div class="col-xl-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Monthly Sales Overview ({{ $year }})</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-area" style="height: 350px;">
                                <canvas id="salesChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Selling Products -->
                <div class="col-xl-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Top Selling Products</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th class="text-right">Qty</th>
                                            <th class="text-right">Revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($topSellingProducts as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if($item->product && $item->product->avatar_url)
                                                            <img src="{{ $item->product->avatar_url }}" alt="" style="width: 30px; height: 30px; object-fit: cover;" class="rounded mr-2">
                                                        @else
                                                            <div style="width: 30px; height: 30px; background: var(--gray-100); border-radius: 4px; display: flex; align-items: center; justify-content: center;" class="mr-2">
                                                                <i class="fas fa-image text-muted" style="font-size: 0.7rem;"></i>
                                                            </div>
                                                        @endif
                                                        <span class="text-truncate" style="max-width: 120px;">{{ $item->product->title ?? 'N/A' }}</span>
                                                    </div>
                                                </td>
                                                <td class="text-right">{{ $item->total_qty }}</td>
                                                <td class="text-right">₹{{ number_format($item->total_revenue, 2) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center py-4">No data available</td>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('salesChart').getContext('2d');
            var salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Sales (₹)',
                        data: {!! json_encode($monthlySales) !!},
                        backgroundColor: 'rgba(102, 126, 234, 0.2)',
                        borderColor: 'rgba(102, 126, 234, 1)',
                        borderWidth: 3,
                        pointBackgroundColor: 'rgba(102, 126, 234, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(102, 126, 234, 1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '₹' + value;
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
@endsection

