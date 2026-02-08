@extends('admin.layouts.master')

@section('title')
    Banners - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Banners</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Banners</li>
@endsection

@section('page_buttons')
    <a class="btn btn-primary my_btn" href="{{ route('admin.banners.create') }}">Add Banner</a>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="card">
                        <div class="card-body">
                            @include('flash::message')
                            @include('admin.banners.table')
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
