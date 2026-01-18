<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">
            {{--            {{ __('Whoops! Something went wrong.') }}--}}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <div id="toast-container" class="alert toast-bottom-right">
                    <div class="toast toast-error" aria-live="assertive" style="display: block;">
                        <button type="button" class="toast-close-button" role="button" onclick="this.parentElement.style.display='none';">×</button>
                        <div class="toast-message">{{ $error }}</div></div>
                </div>
            @endforeach
        </ul>
    </div>
@endif


<script>

    $("document").ready(function(){
        $("div.alert").fadeTo(9000, 1000).fadeOut(1000, function(){
            $(".alert").fadeOut(1000);
        });
    });

</script>
