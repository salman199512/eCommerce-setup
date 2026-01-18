@extends('admin.layouts.master')

@section('title')
    Change Password
@endsection

@section('page_headers')
    <h3><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-key"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /><path d="M15 9h.01" /></svg> Change Password</h3>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Admin Users</a></li>
    <li class="breadcrumb-item active">Change Password</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="card">

                        <div class="card-header">
                            <div class="w-100 d-flex justify-content-between ">
                                <div class="d-flex align-items-center">
                                    <h4>{{ request()->route('user')->name }}</h4>
                                </div>
                                <div class="d-flex align-items-center action_button">
                                    </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::open(['route' => ['admin.users.changePassword.process', request()->route('user')], 'files' => true, 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                <!-- Password Field -->
                                <div class="form-group col-md-12">
                                    {!! Form::label('password', 'Password:') !!}
                                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password of the user']) !!}
                                </div>

                                <!-- Submit Field -->
                                <div class="form-group col-md-12 fields_footer_action_buttons">
                                    <button class="btn btn-primary rspSuccessBtns" type="submit" ><i class="fa-duotone fa-floppy-disk"></i> Save</button>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-danger"><i class="fa-duotone fa-arrow-left-to-line"></i> Back</a>
                                </div>

                            </div>
                            {!! Form::close() !!}
                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('stackedScripts')
    <script>
        $('.submitsByAjax').submit(function (e) {
            e.preventDefault();
            let type = '{{ $type ?? '' }}'
            let dataToPass = new FormData($(this)[0]);
            ajaxCallFormSubmit($(this), false, 'Loading! Please wait...', dataToPass,
                type === 'edit' ? postCreate : undefined);
        });
    </script>
@endpush
