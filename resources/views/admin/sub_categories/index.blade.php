@extends('admin.layouts.master')

@section('title')
    SubCategories - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>SubCategories</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">SubCategories</li>
@endsection

@section('page_buttons')
    <a class="btn btn-primary my_btn" href="{{ route('admin.sub-categories.create') }}">Add SubCategory</a>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="card">
                        <div class="card-body">
                            @include('flash::message')
                            @include('admin.sub_categories.table')
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
