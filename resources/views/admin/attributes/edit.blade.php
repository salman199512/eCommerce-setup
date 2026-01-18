@extends('admin.layouts.master')

@section('title')
    Edit Attribute - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Attributes</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.attributes.index') }}">Attributes</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="card">
                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::model($attribute, ['route' => ['admin.attributes.update', $attribute->uuid], 'method' => 'patch', 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @include('admin.attributes.fields',['type' => 'edit'])
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
