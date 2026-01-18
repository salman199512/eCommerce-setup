@extends('admin.layouts.master')

@section('title')
    View Inquiry - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h3><i class="fa-duotone fa-users mr-2"></i>Inquiries</h3>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.inquiries.index') }}">Inquiries</a></li>
    <li class="breadcrumb-item active">View</li>
@endsection

@section('page_buttons')
    <a class="btn btn-primary" href="{{ route('admin.inquiries.create') }}"><i class="fa-solid fa-plus"></i> Add Inquiries</a>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">


                        <div class="card-header">
                            <div class="w-100 d-flex justify-content-between ">
                                <div class="d-flex align-items-center">
                                    <h4>{!! $inquiry->name !!}</h4>
                                </div>
                                <div class="d-flex align-items-center action_button">
                                    @include('admin.inquiries.datatables_actions', ['uuid' => $inquiry->uuid])
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div id="showinquiry">
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
        </div>
    </div>
@endsection


@push('stackedScripts')
    <script>
        disableInputsForView($('#showinquiry'));
    </script>
@endpush
