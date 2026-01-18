@extends('admin.layouts.master')

@section('title')
    Roles - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-parking-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 16v-8h3.334c.92 0 1.666 .895 1.666 2s-.746 2 -1.666 2h-3.334" /><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /></svg> Roles</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Roles</li>
@endsection

@section('page_buttons')
    <a class="btn btn-primary my_btn" href="{{ route('admin.roles.create') }}"><svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg> Add Roles</a>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="card">
                        <div class="card-body">
                            @include('flash::message')
                            @include('admin.roles.table')
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection

