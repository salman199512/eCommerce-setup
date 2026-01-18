<footer class="footer mt-auto py-3 bg-white text-center">
    <div class="container">
                    <span class="text-muted"> Copyright © {{ date('Y') }}<span id="year"></span> <a
                            href="javascript:void(0);" class="text-dark fw-semibold">{{ config('app.name') }}</a>.
                         All
                        rights
                        reserved
                    </span>
    </div>
</footer>
<script src="{{ asset('assets/jquery_3.5.1/jquery.min.js') }}"></script>
<script src="{{asset('build/assets/libs/@popperjs/core/umd/popper.min.js')}}"></script>
<script src="{{asset('build/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('build/assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('build/assets/libs/simplebar/simplebar.min.js')}}"></script>
<link rel="modulepreload" href="{{asset('build/assets/simplebar-635bad04.js')}}" />
<script type="module" src="{{asset('build/assets/simplebar-635bad04.js')}}"></script>
<script src="{{asset('build/assets/libs/@simonwep/pickr/pickr.es5.min.js')}}"></script>
<script src="{{ asset('assets/select2_4.0.13/js/select2.min.js') }}"></script>
<script src="{{asset('build/assets/sticky.js')}}"></script>
<link rel="modulepreload" href="{{asset('build/assets/app-3cade095.js')}}" />
<script type="module" src="{{asset('build/assets/app-3cade095.js')}}"></script>
<link rel="modulepreload" href="{{asset('build/assets/custom-switcher-383b6a5b.js')}}" />
<script type="module" src="{{asset('build/assets/custom-switcher-383b6a5b.js')}}"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script defer>
    $.ajaxSetup({headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }});
</script>
@include('admin.layouts.inits.master')
@include('layouts.helpers')

@yield('scripts')

@stack('stackedScripts')

<script>
    toastr.options = {
        closeButton: true,
        debug: false,
        progressBar: true,
        preventDuplicates: false,
        positionClass: "toast-top\-right",
        onclick: null,
        showDuration: "2000000",
        hideDuration: "5000",
        timeOut: "9000",
        extendedTimeOut: "1000",
        closeOnHover: false,
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    };
</script>
<script>
    @if (Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('message') }}", {timeOut: 10000});
            break;
    }
    @endif


    $(document).ready(function() {
        $('#slug_text').on('input', function() {
            var slugText = $(this).val();  // Get the text entered by the user
            var slug = slugText
                .toLowerCase()               // Convert to lowercase
                .replace(/\s+/g, '-')         // Replace spaces with hyphens
                .replace(/[^\w\-]+/g, '')     // Remove any non-word characters (except hyphens)
                .replace(/--+/g, '-')         // Replace multiple hyphens with a single one
                .replace(/^-+|-+$/g, '');     // Trim hyphens from the beginning and end

            $('#slug').val(slug);  // Set the generated slug in the slug input field


            @if(request()->segment(2) == 'posts')
            $('#meta_title').val(slugText);  // Set the generated slug in the slug input field

            $('#meta_keyword').val(slugText);  // Set the generated slug in the slug input field
           @endif
        });

        $('#description').on('input', function() {
            $('#meta_description').val($(this).val());  // Set the generated slug in the slug input field
        })
    });


</script>
