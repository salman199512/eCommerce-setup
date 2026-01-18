@extends('admin.layouts.master')

@section('title')
    Attributes - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Attributes</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Attributes</li>
@endsection

@section('page_buttons')
    <a class="btn btn-primary my_btn" href="{{ route('admin.attributes.create') }}">Add Attribute</a>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="card">
                        <div class="card-body">
                            @include('flash::message')
                            @include('admin.attributes.table')
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
