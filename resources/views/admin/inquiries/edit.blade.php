@extends('admin.layouts.master')

@section('title')
    Edit Inquiry - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Inquiries</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.inquiries.index') }}">Inquiries</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="card">

                        <div class="card-header">
                            <div class="w-100 d-flex justify-content-between ">
                                <div class="d-flex align-items-center">
                                    <h4>{!! $inquiry->name !!}</h4>
                                </div>
                                <div class="d-flex align-items-center action_button">

                                    </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::model($inquiry, ['route' => ['admin.inquiries.update', $inquiry->uuid], 'method' => 'patch',  'files' => true, 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @include('admin.inquiries.fields', ['type' => 'edit'])
                            </div>
                            {!! Form::close() !!}
                        </div>

                    </div>
            </div>
        </div>
    </div>
@endsection
