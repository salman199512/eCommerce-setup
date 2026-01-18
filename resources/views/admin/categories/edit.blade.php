@extends('admin.layouts.master')

@section('title')
    Edit Category - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Categories</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="card">
                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::model($category, ['route' => ['admin.categories.update', $category->uuid], 'method' => 'patch', 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @include('admin.categories.fields',['type' => 'edit'])
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
