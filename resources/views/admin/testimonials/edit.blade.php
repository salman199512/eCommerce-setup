@extends('admin.layouts.master')
@section('title', 'Edit Testimonial')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0">Edit Testimonial</h5>
                </div>
                <div class="card-body">
                    {!! Form::model($testimonial, ['route' => ['admin.testimonials.update', $testimonial->uuid], 'method' => 'patch', 'files' => true, 'class' => 'submitsByAjax']) !!}
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
