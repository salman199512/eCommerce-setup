<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @include('frontend.layouts.head')
</head>
<body>

    @include('frontend.layouts.header')

    <main style="min-height:60vh;">
        @yield('content')
    </main>

    @include('frontend.layouts.footer')

    <!-- Global Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <script>
        toastr.options = { closeButton: true, progressBar: true, positionClass: "toast-top-right" };
        @if(Session::has('success')) toastr.success("{{ Session::get('success') }}"); @endif
        @if(Session::has('error'))   toastr.error("{{ Session::get('error') }}"); @endif
        @if(Session::has('info'))    toastr.info("{{ Session::get('info') }}"); @endif
        @if(Session::has('warning')) toastr.warning("{{ Session::get('warning') }}"); @endif
    </script>

    @stack('scripts')

    <!-- Cookie Consent -->
    <div id="cookie-banner" style="display:none;position:fixed;bottom:0;left:0;right:0;z-index:9999;background:rgba(17,24,39,.97);backdrop-filter:blur(10px);border-top:1px solid rgba(255,255,255,.08);padding:20px 24px;">
        <div style="max-width:1280px;margin:0 auto;display:flex;align-items:center;gap:20px;flex-wrap:wrap;">
            <i class="fas fa-cookie-bite" style="font-size:1.5rem;color:var(--yellow-primary);flex-shrink:0;"></i>
            <p style="flex:1;color:rgba(255,255,255,.75);font-size:.82rem;font-weight:500;min-width:200px;">
                We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies.
                <a href="#" style="color:var(--green-light);font-weight:700;">Privacy Policy</a>
            </p>
            <div style="display:flex;gap:10px;flex-shrink:0;">
                <button id="cookie-decline" class="btn btn-sm" style="background:transparent;border:1px solid rgba(255,255,255,.2);color:rgba(255,255,255,.6);">Decline</button>
                <button id="cookie-accept" class="btn btn-primary btn-sm">Accept All</button>
            </div>
        </div>
    </div>
    <script>
    (function() {
        var b = document.getElementById('cookie-banner');
        if (!localStorage.getItem('cookie_consent')) setTimeout(() => b.style.display='block', 1000);
        function hide() { b.style.opacity='0'; b.style.transition='opacity .4s'; setTimeout(() => b.style.display='none', 400); }
        document.getElementById('cookie-accept').addEventListener('click', () => { localStorage.setItem('cookie_consent','accepted'); hide(); });
        document.getElementById('cookie-decline').addEventListener('click', () => { localStorage.setItem('cookie_consent','declined'); hide(); });
    })();
    </script>
</body>
</html>
