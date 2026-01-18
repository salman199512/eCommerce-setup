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
                    <p class="h5 fw-semibold mb-2 text-center">Sign In</p>
                    <p class="mb-4 text-muted op-7 fw-normal text-center">Sign in to continue to Ramdev Oil.</p>
                    <form method="POST" action="{{ route('login') }}" data-toggle="validator">
                        @csrf
                    <div class="row gy-3">
                        <div class="col-xl-12">
                            <label for="signin-username" class="form-label text-default">Email</label>
                            <input type="email" value="{{ old('email') }}" class="form-control " id="signin-username" name="email" placeholder="user name">
                        </div>
                        <div class="col-xl-12 mb-2">
                            <label for="signin-password" class="form-label text-default d-block">Password<a href="{{ route('password.request') }}" class="float-end text-danger">Forget password ?</a></label>
                            <div class="input-group">
                                <input type="password" class="form-control " name="password" id="signin-password" placeholder="password">
                                <button class="btn btn-light" type="button" onclick="createpassword('signin-password',this)" id="button-addon2"><i class="align-middle ri-eye-off-line"></i></button>
                            </div>
                            <div class="mt-2">
                                <div class="form-check">
                                    <input  {{ old('remember') ? 'checked' : '' }} class="form-check-input" type="checkbox" name="remember" value="" id="defaultCheck1">
                                    <label class="form-check-label text-muted fw-normal" for="defaultCheck1">
                                        Remember password ?
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4  d-grid mt-3 mb-3" style="margin: auto;">
                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </div>
                        <br>
                        <br>
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
