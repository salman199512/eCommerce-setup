@extends('admin.layouts.master')

@section('title')
    Payment History
@endsection

@section('page_headers')
    <h4><i class="ti ti-credit-card fs-18 me-2"></i> Payment History</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Payment History</li>
@endsection

@section('css')
    @include('admin.layouts.datatables_css')
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                {!! $dataTable->table(['class' => 'table table-hover align-middle w-100', 'id' => 'payment-table']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('stackedScripts')
    @include('admin.layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endpush
