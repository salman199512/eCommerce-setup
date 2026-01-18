@extends('admin.layouts.master')

@section('title')
    News Letters - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4> News Letters</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">News Letters</li>
@endsection


@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="card">

                        <div class="card-body">
                            @include('flash::message')
                            @include('admin.newsletters.table')
                        </div>

                    </div>
            </div>
        </div>
    </div>
@endsection
