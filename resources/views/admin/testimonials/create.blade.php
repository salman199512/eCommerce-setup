@extends('admin.layouts.master')
@section('title', 'Creat Testimonial')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0">Create Testimonial</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'admin.testimonials.store', 'files' => true, 'class' => 'submitsByAjax']) !!}
                        <div class="row">
                            @include('admin.testimonials.fields')
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
