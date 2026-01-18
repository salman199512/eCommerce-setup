@@extends('admin.layouts.master')

@@section('title')
    Edit {{ $config->modelNames->human }} - {{ config('app.name') }}
@@endsection

@@section('page_headers')
    <h4><i class="fa-duotone fa-users mr-2"></i>{{ $config->modelNames->humanPlural }}</h4>
@@endsection

@@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="@{{ route('{!! $config->prefixes->getRoutePrefixWith('.') !!}{!! $config->modelNames->camelPlural !!}.index') }}">{{ $config->modelNames->humanPlural }}</a></li>
    <li class="breadcrumb-item active">Edit</li>
@@endsection


@@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="card">

                        <div class="card-header">
                            <div class="w-100 d-flex justify-content-between ">
                                <div class="d-flex align-items-center">
                                    <h4>@{!! ${{ $config->modelNames->camel }}->name !!}</h4>
                                </div>
                                <div class="d-flex align-items-center action_button">

                                    </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @@include('adminlte-templates::common.errors')
                            @{!! Form::model(${{ $config->modelNames->camel }}, ['route' => ['{{ $config->prefixes->getRoutePrefixWith('.') }}{{ $config->modelNames->camelPlural }}.update', ${{ $config->modelNames->camel }}->{{ $config->primaryName }}], 'method' => 'patch',  'files' => true, 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @@include('{{ $config->prefixes->getViewPrefixForInclude() }}{{ $config->modelNames->snakePlural }}.fields', ['type' => 'edit'])
                            </div>
                            @{!! Form::close() !!}
                        </div>

                    </div>
            </div>
        </div>
    </div>
@@endsection
