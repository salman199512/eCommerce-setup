@extends('admin.layouts.master')

@section('title')
    Brand Details - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4>Brand Details</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.brands.index') }}">Brands</a></li>
    <li class="breadcrumb-item active">Show</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <dl class="row">
                                        <dt class="col-sm-3">Name</dt>
                                        <dd class="col-sm-9">{{ $brand->name }}</dd>

                                        <dt class="col-sm-3">Status</dt>
                                        <dd class="col-sm-9">{!! $brand->status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' !!}</dd>

                                        <dt class="col-sm-3">Created At</dt>
                                        <dd class="col-sm-9">{{ $brand->created_at->format('d-m-Y H:i:s') }}</dd>

                                        <dt class="col-sm-3">Icon</dt>
                                        <dd class="col-sm-9">
                                            @if($brand->hasMedia('brand_icon'))
                                                <img src="{{ $brand->brand_icon['250'] }}" alt="{{ $brand->name }}" class="img-thumbnail" width="150">
                                            @else
                                                <span class="text-muted">No icon uploaded</span>
                                            @endif
                                        </dd>
                                    </dl>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ route('admin.brands.index') }}" class="btn btn-default">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
