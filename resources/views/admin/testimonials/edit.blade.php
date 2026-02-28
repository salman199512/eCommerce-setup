@extends('admin.layouts.master')

@section('title')
    Edit Testimonial - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Testimonials</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.testimonials.index') }}">Testimonials</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        {!! Form::model($testimonial, ['route' => ['admin.testimonials.update', $testimonial->uuid], 'method' => 'patch', 'files' => true, 'class' => 'submitsByAjax']) !!}
                        <div class="row">
                            @include('admin.testimonials.fields', ['type' => 'edit'])
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
