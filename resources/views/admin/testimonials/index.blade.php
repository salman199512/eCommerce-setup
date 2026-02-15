@extends('admin.layouts.master')
@section('title', 'Testimonials')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0 float-left">Testimonials</h5>
                    <a class="btn btn-primary float-right" href="{{ route('admin.testimonials.create') }}">
                        <i class="fa-duotone fa-plus"></i> Add New
                    </a>
                </div>
                <div class="card-body">
                    @include('admin.testimonials.table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
