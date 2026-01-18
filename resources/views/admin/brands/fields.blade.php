<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name of the brand']) !!}
</div>


@php $hasAvatar = !empty($brand) ? $brand->hasMedia('avatar') : false @endphp
@include('admin.layouts.scripts.dzSingleImageField', [
    'record' => isset($brand) ? $brand : '',
    'hasMedia' => $hasAvatar,
    'previewUrl' => $hasAvatar ? $brand->avatarUrl['100'] : route('images_default',['resolution' => '250x250']),
    'mediaUuid' => $hasAvatar ? $brand->getFirstMedia('avatar')->uuid ?? '' : '',
    'fieldName' => 'avatar',
    'elementId' => 'user_avatar',
     'placeHolderText' => "Drop/Select Brand Icon<br/>(Max: 1 MB)"
])
<!-- Submit Field -->
<div class="form-group col-md-12 fields_footer_action_buttons">
    <button class="btn btn-primary rspSuccessBtns" type="submit" ><i class="fa-duotone fa-floppy-disk"></i> Save</button>
    <a href="{{ route('admin.brands.index') }}" class="btn  btn-outline-danger"><i class="fa-duotone fa-arrow-left-to-line"></i> Back</a>
</div>

@push('stackedScripts')
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')

    <script>
        Dropzone.autoDiscover = false;
        uploadImageByDropzone('#user_avatar');

        $('.submitsByAjax').submit(function (e) {
            e.preventDefault();
            let type = '{{ $type ?? '' }}'
            let dataToPass = new FormData($(this)[0]);
            ajaxCallFormSubmit($(this), false, 'Loading! Please wait...', dataToPass,
                type === 'create' ? postCreate : undefined);
        });

        function postCreate(){
            switch_between_register_to_registerAnother_btn($('.submitsByAjax'), false)
        }
    </script>
@endpush
