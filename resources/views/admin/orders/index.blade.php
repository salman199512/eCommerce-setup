@extends('admin.layouts.master')

@section('title')
    Orders - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Orders</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Orders</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="card">
                        <div class="card-body">
                            @include('flash::message')
                            @include('admin.orders.table')
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
