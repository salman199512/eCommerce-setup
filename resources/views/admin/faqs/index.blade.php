@extends('admin.layouts.master')

@section('title')
    Faqs - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Faqs</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Faqs</li>
@endsection

@section('page_buttons')
    <a class="btn btn-primary my_btn" href="{{ route('admin.faqs.create') }}"><svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>  Add Faqs</a>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="card">

                        <div class="card-body">
                            @include('flash::message')
                            @include('admin.faqs.table')
                        </div>

                    </div>
            </div>
        </div>
    </div>
@endsection
