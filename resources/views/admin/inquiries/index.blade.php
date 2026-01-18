@extends('admin.layouts.master')

@section('title')
    Inquiries - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Inquiries</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Inquiries</li>
@endsection

@section('page_buttons')

@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">

                    <div class="card-body">
                        @include('flash::message')
                        @include('admin.inquiries.table')
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
