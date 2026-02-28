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

    <!-- Global Dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    
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

    <!-- Cookie Consent Banner -->
    <div id="cookie-banner" style="display:none;"
         class="fixed bottom-0 left-0 right-0 z-[9999] bg-black/95 backdrop-blur-sm border-t border-white/10 px-6 py-5 md:px-10">
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-start md:items-center gap-6">
            <p class="text-white text-sm leading-relaxed flex-1">
                This website uses cookies to ensure you get the best experience on our website.
                <a href="#" class="font-black underline underline-offset-2 hover:text-red-400 transition ml-1">Privacy Policy</a>
            </p>
            <div class="flex items-center gap-4 shrink-0">
                <button id="cookie-decline"
                        class="px-6 py-3 text-[11px] font-black uppercase tracking-widest text-white border border-white/30 rounded-xl hover:border-white transition-all duration-300">
                    Not agree
                </button>
                <button id="cookie-accept"
                        class="px-8 py-3 text-[11px] font-black uppercase tracking-widest bg-white text-black rounded-xl hover:bg-red-600 hover:text-white transition-all duration-500 shadow-xl shadow-black/20">
                    Agree
                </button>
            </div>
        </div>
    </div>

    <script>
        // Cookie Consent Logic
        (function () {
            var banner = document.getElementById('cookie-banner');
            var accepted = localStorage.getItem('cookie_consent');
            if (!accepted) {
                setTimeout(function () { banner.style.display = 'block'; }, 800);
            }
            document.getElementById('cookie-accept').addEventListener('click', function () {
                localStorage.setItem('cookie_consent', 'accepted');
                banner.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                banner.style.opacity = '0';
                banner.style.transform = 'translateY(20px)';
                setTimeout(function () { banner.style.display = 'none'; }, 400);
            });
            document.getElementById('cookie-decline').addEventListener('click', function () {
                localStorage.setItem('cookie_consent', 'declined');
                banner.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                banner.style.opacity = '0';
                banner.style.transform = 'translateY(20px)';
                setTimeout(function () { banner.style.display = 'none'; }, 400);
            });
        })();
    </script>
</body>
</html>
