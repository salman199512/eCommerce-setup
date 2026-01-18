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
                    <p class="h5 fw-semibold mb-2 text-center">Forgot Password !</p>
                    <p class="mb-4 text-muted op-7 fw-normal text-center">Enter your User name and instructions will be sent to you!</p>
                    <form method="POST" action="{{ route('password.email') }}" data-toggle="validator">
                        @csrf
                        <div class="row gy-3">
                            <div class="col-xl-12">
                                <label for="signin-username" class="form-label text-default">Email</label>
                                <input type="email" value="{{ old('email') }}" class="form-control " id="signin-username" name="email" placeholder="Email">
                            </div>

                            <div class="col-xl-12 d-grid mt-3 mb-3">
                                <button type="submit" class="btn  btn-primary"> {{ __('Email Password Reset Link') }}</button>
                            </div>

                            <div class="col-12">
                                <div class="text-center">

                                    @if (Route::has('password.request'))
                                        Back to  <a
                                            class="underline text-sm text-gray-600 hover:text-gray-900 text-danger"
                                            href="{{ route('login') }}">
                                            {{ __(' Sign in') }}
                                        </a>
                                    @endif

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
