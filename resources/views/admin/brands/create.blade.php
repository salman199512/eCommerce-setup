@extends('admin.layouts.master')

@section('title')
    Create Brand - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Brands</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.brands.index') }}">Brands</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="card">
                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::open(['route' => 'admin.brands.store', 'files' => true, 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @include('admin.brands.fields',['type' => 'create'])
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
