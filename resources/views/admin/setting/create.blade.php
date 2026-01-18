@extends('admin.layouts.master')

@section('title')
    Company Detail - News
@endsection



@section('page_headers')
    <h4><i class="fa-duotone fa-setting mr-2"></i>Company Detail</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Company</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">

                    <div class="card-body">
                        @include('adminlte-templates::common.errors')
                        {!! Form::open(['route' => 'admin.setting.store',  'files' => true, 'class' => 'submitsByAjax']) !!}
                        <div class="row">
                            @include('admin.setting.fields', ['type' => 'create'])
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
