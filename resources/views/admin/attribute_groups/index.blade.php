@extends('admin.layouts.master')

@section('title')
    Attribute Groups - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Attribute Groups</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Attribute Groups</li>
@endsection

@section('page_buttons')
    <a class="btn btn-primary my_btn" href="{{ route('admin.attribute-groups.create') }}">Add Attribute Group</a>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="card">
                        <div class="card-body">
                            @include('flash::message')
                            @include('admin.attribute_groups.table')
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
