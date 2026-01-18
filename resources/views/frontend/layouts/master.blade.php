<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    @include('frontend.layouts.head')
</head>
<body>


<div class="main_page">
    <!-- Header Section Start -->
    @include('frontend.layouts.header')
    <!-- Posts Filter Bar End -->

    @yield('content')

    <!-- Footer Section Start -->
    @include('frontend.layouts.footer')
    <!-- Footer Section End -->
</div>
<!-- Wrapper End -->

<!-- Sticky Social Start -->

<!-- Sticky Social End -->

<!-- Back To Top Button Start -->

<!-- Back To Top Button End -->
<script type="text/javascript" src="{{ asset('web/js/jquery-2.1.4.js')}}"></script>
<!-- Bootstrap JS -->
<script type="text/javascript" src="{{ asset('web/js/bootstrap.min.js')}}"></script>

<!-- Vendor js _________ -->
<!-- Google map js -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRvBPo3-t31YFk588DpMYS6EqKf-oGBSI"></script> <!-- Gmap Helper -->
<script src="{{ asset('web/js/gmap.js')}}"></script>
<!-- owl.carousel -->
<script type="text/javascript" src="{{ asset('web/js/owl.carousel.min.js')}}"></script>
<!-- ui js -->
<script type="text/javascript" src="{{ asset('web/js/jquery-ui.min.js')}}"></script>
<!-- Responsive menu-->
<script type="text/javascript" src="{{ asset('web/js/menuzord.js')}}"></script>
<!-- revolution -->
<script src="{{ asset('web/vendor/revolution/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{ asset('web/vendor/revolution/jquery.themepunch.revolution.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('web/vendor/revolution/revolution.extension.slideanims.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('web/vendor/revolution/revolution.extension.layeranimation.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('web/vendor/revolution/revolution.extension.navigation.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('web/vendor/revolution/revolution.extension.kenburn.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('web/vendor/revolution/revolution.extension.actions.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('web/vendor/revolution/revolution.extension.parallax.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('web/vendor/revolution/revolution.extension.migration.min.js')}}"></script>

<!-- landguage switcher js -->
<script type="text/javascript" src="{{ asset('web/js/jquery.polyglot.language.switcher.js')}}"></script>
<!-- Fancybox js -->
<script type="text/javascript" src="{{ asset('web/js/jquery.fancybox.pack.js')}}"></script>
<!-- js count to -->
<script type="text/javascript" src="{{ asset('web/js/jquery.appear.js')}}"></script>
<script type="text/javascript" src="{{ asset('web/js/jquery.countTo.js')}}"></script>
<!-- WOW js -->
<script type="text/javascript" src="{{ asset('web/js/wow.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('web/js/SmoothScroll.js')}}"></script>

<script src="{{ asset('web/js/bootstrap-select.min.js')}}"></script>
<script src="{{ asset('web/js/jquery.mixitup.min.js')}}"></script>
<!-- Theme js -->
<script type="text/javascript" src="{{ asset('web/js/theme.js')}}"></script>
<script type="text/javascript" src="{{ asset('web/js/google-map.js')}}"></script>

</body>
</html>
