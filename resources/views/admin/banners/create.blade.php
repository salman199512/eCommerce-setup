@extends('admin.layouts.master')

@section('title')
    Add Banner - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Add Banner</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}">Banners</a></li>
    <li class="breadcrumb-item active">Add Banner</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.banners.store', 'class' => 'submitsByAjax', 'files' => true]) !!}
                        <div class="row">
                            @include('admin.banners.fields', ['type' => 'create'])
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
