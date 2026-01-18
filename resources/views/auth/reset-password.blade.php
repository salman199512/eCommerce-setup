<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.layouts.head')

</head>
<body class="form">


<div class="container">
    <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
        <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
            <div class="my-3 d-flex justify-content-center">
                <a href="" class="" style="">
                    <img style="height: 100px;" src="{{ \App\MyClasses\GeneralHelperFunctions::getSetting('image') }}">
                </a>
            </div>
            <div class="card custom-card">
                <div class="card-body p-4">
                    <p class="h5 fw-semibold mb-2 text-center">Reset Password !</p>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="row gy-3">
                            <div class="col-xl-12">
                                <label for="signin-username" class="form-label text-default">Email</label>
                                <input type="email" value="{{ old('email', $request->email) }}" class="form-control " id="signin-username" name="email" placeholder="Email">
                            </div>

                            <div class="col-xl-12 mb-2">
                                <label for="signin-password" class="form-label text-default d-block">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control " name="password" id="signin-password" placeholder="password">
                                    <button class="btn btn-light" type="button" onclick="createpassword('signin-password',this)" id="button-addon2"><i class="align-middle ri-eye-off-line"></i></button>
                                </div>

                            </div>

                            <div class="col-xl-12 mb-2">
                                <label for="signinc-password" class="form-label text-default d-block">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control " name="password_confirmation" id="signinc-password" placeholder="password">
                                    <button class="btn btn-light" type="button" onclick="createpassword('signinc-password',this)" id="button-addon2"><i class="align-middle ri-eye-off-line"></i></button>
                                </div>

                            </div>


                            <div class="col-xl-12 d-grid mt-3 mb-3">
                                <button type="submit" class="btn  btn-primary">  {{ __('Reset Password') }}</button>
                            </div>

                            <div class="col-12">
                                <div class="text-center">



                                    {{--                                            <p class="mb-0"><br>Dont't have an account ? <a href="javascript:void(0);" class="text-warning">Sign Up</a></p>--}}
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<x-auth-validation-errors/>
<script src="{{ asset('asset_app/html/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://laravelui.spruko.com/ynex/build/assets/show-password.js"></script>

</body>
</html>
