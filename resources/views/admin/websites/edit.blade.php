@extends('admin.layouts.master')

@section('title')
    Edit Website - TeleBark
@endsection

@section('page_headers')
    <h4><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list side-menu__icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 6l11 0"></path><path d="M9 12l11 0"></path><path d="M9 18l11 0"></path><path d="M5 6l0 .01"></path><path d="M5 12l0 .01"></path><path d="M5 18l0 .01"></path></svg> Websites</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.websites.index') }}">Websites</a></li>
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
                                    <h4>{!! $website->name !!}</h4>
                                </div>
                                <div class="d-flex align-items-center action_button">

                                    </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::model($website, ['route' => ['admin.websites.update', $website->uuid], 'method' => 'patch',  'files' => true, 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @include('admin.websites.fields', ['type' => 'edit'])
                            </div>
                            {!! Form::close() !!}
                        </div>

                    </div>
            </div>
        </div>
    </div>
@endsection
