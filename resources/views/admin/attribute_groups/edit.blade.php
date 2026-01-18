@extends('admin.layouts.master')

@section('title')
    Edit Attribute Group - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Attribute Groups</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.attribute-groups.index') }}">Attribute Groups</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="card">
                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::model($attributeGroup, ['route' => ['admin.attribute-groups.update', $attributeGroup->uuid], 'method' => 'patch', 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @include('admin.attribute_groups.fields',['type' => 'edit'])
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
