<meta charset="UTF-8">
<title>@yield('title', config('app.name'))</title>

<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<meta name="_token" content="{!! csrf_token() !!}"/>
<link rel="stylesheet" href="{{ asset('css/fa/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/laravel_project.css') }}">
<link rel="stylesheet" href="{{ asset('css/ntb.css') }}">
<link rel="icon" href="{{ \App\MyClasses\GeneralHelperFunctions::getSetting('image') }}" type="image/x-icon">
<link rel="icon" href="{{ \App\MyClasses\GeneralHelperFunctions::getSetting('image') }}" type="image/x-icon">
<link  id="style" href="{{asset('build/assets/libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('build/assets/icon-fonts/icons.css')}}" rel="stylesheet">
<link rel="preload" as="style" href="{{asset('build/assets/app-fce3f544.css')}}" />
<link rel="stylesheet" href="{{asset('build/assets/app-fce3f544.css')}}" />
<link href="{{asset('build/assets/libs/node-waves/waves.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('build/assets/libs/simplebar/simplebar.min.css')}}">
<link rel="stylesheet" href="{{asset('build/assets/libs/flatpickr/flatpickr.min.css')}}">
<link rel="stylesheet" href="{{asset('build/assets/libs/@simonwep/pickr/themes/nano.min.css')}}">
<link rel="stylesheet" href="{{asset('build/assets/libs/choices.js/public/assets/styles/choices.min.css')}}">
<script src="{{asset('build/assets/libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>
<script src="{{asset('build/assets/main.js')}}"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<link href="{{ asset('css/admin.css') }}" rel="stylesheet" type="text/css"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="{{ asset('assets/select2_4.0.13/css/select2.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" type="text/css" />


<style>
    :root {

        --font-family-theme: 'Poppins', sans-serif;
        --color-text: #7b6f36;
        --bg-color:#f89c1d;
    }
    :root {
        /* Light theme colors */
        --body-bg-rgb: 240, 241, 247;
        --primary-rgb: 248, 159, 29;
        --secondary-rgb: rgba(1, 1, 108, 1);
        --warning-rgb: 245, 184, 73;
        --info-rgb: 73, 182, 245;
        --success-rgb: 38, 191, 148;
        --danger-rgb: 230, 83, 60;
        --light-rgb: 243, 246, 248;
        --dark-rgb: 35, 35, 35;
        --orange-rgb: 255, 165, 5;
        --pink-rgb: 231, 145, 188;
        --teal-rgb: 18, 194, 194;
        --purple-rgb: 137, 32, 173;
        --default-body-bg-color: rgb(var(--body-bg-rgb));
        --primary-color: rgb(var(--primary-rgb));
        --primary-border: rgb(var(--primary-rgb));
        --primary01: rgba(var(--primary-rgb), .1);
        --primary02: rgba(var(--primary-rgb), .2);
        --primary03: rgba(var(--primary-rgb), .3);
        --primary04: rgba(var(--primary-rgb), .4);
        --primary05: rgba(var(--primary-rgb), .5);
        --primary06: rgba(var(--primary-rgb), .6);
        --primary07: rgba(var(--primary-rgb), .7);
        --primary08: rgba(var(--primary-rgb), .8);
        --primary09: rgba(var(--primary-rgb), .9);
        --primary005: rgba(var(--primary-rgb), .05);
        --default-font-family: "Inter", sans-serif;
        --default-font-weight: 400;
        --default-text-color: #333335;
        --default-border: #f3f3f3;
        --default-background: #f7f8f9;
        --menu-bg: #fff;
        --menu-prime-color: #536485;
        --menu-border-color: #f3f3f3;
        --header-bg: #fff;
        --header-prime-color: #536485;
        --header-border-color: #f3f3f3;
        --custom-white: #fff;
        --custom-black: #000;
        --bootstrap-card-border: #f3f3f3;
        --list-hover-focus-bg: #f5f6f7;
        --text-muted: #8c9097;
        --input-border: #c3c3c3;
        --form-control-bg: #ffffff;
        --gray-1: #f9fafb;
        --gray-2: #f2f4f5;
        --gray-3: #e6eaeb;
        --gray-4: #dbdfe1;
        --gray-5: #949eb7;
        --gray-6: #7987a1;
        --gray-7: #4d5875;
        --gray-8: #383853;
        --gray-9: #323251;
        --white-1: rgba(255,255,255, .1);
        --white-2: rgba(255,255,255, .2);
        --white-3: rgba(255,255,255, .3);
        --white-4: rgba(255,255,255, .4);
        --white-5: rgba(255,255,255, .5);
        --white-6: rgba(255,255,255, .6);
        --white-7: rgba(255,255,255, .7);
        --white-8: rgba(255,255,255, .8);
        --white-9: rgba(255,255,255, .9);
        --black-1: rgba(0,0,0, .1);
        --black-2: rgba(0,0,0, .2);
        --black-3: rgba(0,0,0, .3);
        --black-4: rgba(0,0,0, .4);
        --black-5: rgba(0,0,0, .5);
        --black-6: rgba(0,0,0, .6);
        --black-7: rgba(0,0,0, .7);
        --black-8: rgba(0,0,0, .8);
        --black-9: rgba(0,0,0, .9);
    }

    /* Dark theme overrides */
    [data-theme-mode="dark"] {
        --body-bg-rgb: 26, 28, 30;
        --body-bg-rgb2: 37, 39, 41;
        --menu-bg: rgb(var(--body-bg-rgb));
        --menu-border-color: rgba(255, 255, 255, 0.1);
        --menu-prime-color: rgba(255, 255, 255, 0.6);
        --header-bg: rgb(var(--body-bg-rgb));
        --header-prime-color: rgba(255, 255, 255, 0.6);
        --header-border-color: rgba(255, 255, 255, 0.1);
        --custom-white: rgb(var(--body-bg-rgb));
        --custom-black: #fff;
        --default-border: rgba(255, 255, 255, 0.1);
        --default-text-color: rgba(255, 255, 255, 0.7);
        --light-rgb: 43, 46, 49;
        --dark-rgb: 240, 245, 248;
        --bootstrap-card-border: rgba(255, 255, 255, 0.1);
        --list-hover-focus-bg: rgba(255, 255, 255, 0.1);
        --default-background: rgba(255, 255, 255, 0.07);
        --default-body-bg-color: rgb(var(--body-bg-rgb2));
        --text-muted: rgba(255, 255, 255, 0.5);
        --input-border: #313335;
        --form-control-bg: #232628;
        --gray-100: #110f0f;
        --gray-200: #17171c;
        --gray-300: #393946;
        --gray-400: #505062;
        --gray-500: #73738c;
        --gray-600: #8f8fa3;
        --gray-700: #ababba;
        --gray-800: #c7c7d1;
        --gray-900: #e3e3e8;
        --white-1: rgba(0,0,0,.1);
        --white-2: rgba(0,0,0,.2);
        --white-3: rgba(0,0,0,.3);
        --white-4: rgba(0,0,0,.4);
        --white-5: rgba(0,0,0,.5);
        --white-6: rgba(0,0,0,.6);
        --white-7: rgba(0,0,0,.7);
        --white-8: rgba(0,0,0,.8);
        --white-9: rgba(0,0,0,.9);
        --black-1: rgba(255,255,255,.05);
        --black-2: rgba(255,255,255,.2);
        --black-3: rgba(255,255,255,.3);
        --black-4: rgba(255,255,255,.4);
        --black-5: rgba(255,255,255,.5);
        --black-6: rgba(255,255,255,.6);
        --black-7: rgba(255,255,255,.7);
        --black-8: rgba(255,255,255,.8);
        --black-9: rgba(255,255,255,.9);
    }




    body{
        font-family: var( --font-family-theme);
    }
</style>
@yield('css')
@stack('stackedCss')
