@extends('admin.layouts.master')

@section('title')
    Edit Banner - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Edit Banner</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}">Banners</a></li>
    <li class="breadcrumb-item active">Edit Banner</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        {!! Form::model($banner, ['route' => ['admin.banners.update', $banner->uuid], 'method' => 'patch', 'class' => 'submitsByAjax', 'files' => true]) !!}
                        <div class="row">
                            @include('admin.banners.fields', ['type' => 'edit'])
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
