@extends('admin.layouts.master')

@section('title')
    Create Product - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Products</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="card">
                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::open(['route' => 'admin.products.store', 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @include('admin.products.fields',['type' => 'create'])
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
