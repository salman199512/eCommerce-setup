<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @include('frontend.layouts.head')
</head>
<body class="bg-gray-50 font-sans text-gray-900 antialiased">
    
    @include('frontend.layouts.header')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('frontend.layouts.footer')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script>
        // Toastr Options
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
        }

        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif

        @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif

        @if(Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif
    </script>

    @stack('scripts')
</body>
</html>
