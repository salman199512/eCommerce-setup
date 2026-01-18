<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>@yield('title') || RamdevOil</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{asset('css/web.css')}}" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .notfound .notfound-404 h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 118px;
            margin: 0px;
            font-weight: 900;
            position: absolute;
            left: 50%;
            -webkit-transform: translateX(-50%);
            -ms-transform: translateX(-50%);
            transform: translateX(-50%);
            background: url('{{ asset('bgError.jpg') }}') no-repeat;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: cover;
            background-position: center;
            top: -4%;
        }
        body {
            padding: 0;
            margin: 0;
            background-color: #ffbd9e !important;
        }
        @media only screen and (max-width: 767px) {
            .notfound .notfound-404 h1 {
                top: -110px;
            }
        }


    </style>

</head>


<body>

<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>Oops! @yield('code')</h1>
        </div>
        <p> We’re sorry, @yield('message')</p>
        <a href="{{route('home')}}">Go To Homepage</a>
    </div>
</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
