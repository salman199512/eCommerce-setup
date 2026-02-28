@extends('admin.layouts.master')

@section('title')
    Testimonials - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Testimonials</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Testimonials</li>
@endsection

@section('page_buttons')
    <a class="btn btn-primary my_btn" href="{{ route('admin.testimonials.create') }}">Add Testimonial</a>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        @include('flash::message')
                        @include('admin.testimonials.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
