@extends('admin.layouts.master')

@section('title')
    Customers - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Customers</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Customers</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        @include('flash::message')
                        {!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
