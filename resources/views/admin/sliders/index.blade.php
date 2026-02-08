@extends('admin.layouts.master')

@section('title')
    Sliders - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Sliders</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Sliders</li>
@endsection

@section('page_buttons')
    <a class="btn btn-primary my_btn" href="{{ route('admin.sliders.create') }}">Add Slider</a>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="card">
                        <div class="card-body">
                            @include('flash::message')
                            @include('admin.sliders.table')
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
