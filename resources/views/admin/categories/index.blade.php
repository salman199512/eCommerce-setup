@extends('admin.layouts.master')

@section('title')
    Categories - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Categories</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('page_buttons')
    <a class="btn btn-primary my_btn" href="{{ route('admin.categories.create') }}">Add Category</a>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="card">
                        <div class="card-body">
                            @include('flash::message')
                            @include('admin.categories.table')
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
