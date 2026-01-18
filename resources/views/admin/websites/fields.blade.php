<!-- Heading Field -->
<div class="col-sm-9">
    <div class="row" style="padding: 0 7px">
        <div class="form-group col-sm-4">
            {!! Form::label('heading', 'Heading:') !!}
            {!! Form::text('heading', null, ['class' => 'form-control', 'required']) !!}
        </div>

        <!-- Sub Heading Field -->
        <div class="form-group col-sm-4">
            {!! Form::label('sub_heading', 'Sub Heading:') !!}
            {!! Form::text('sub_heading', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Type Field -->
        <div class="form-group col-sm-4">
            {!! Form::label('type', 'Type:') !!}
            {!! Form::select('type', [
        '' => 'Select Type',
        'Top_Banner' => 'Top Banner',
        'About_Us' => 'About Us',
        'Our_Vision' => 'Our Vision',
        'Our_Mission' => 'Our Mission',
        'Reviews' => 'Reviews',
    ], null, ['class' => 'form-control custom-select']) !!}
        </div>
    </div>

    @include('admin.layouts.editor',
    [
        'editorId' => 'editor',
        'editorFieldName' => 'description',
        'editorFieldLabelName' => 'Description',
    ])
</div>
@php $hasAvatar = !empty($website) ? $website->hasMedia('avatar') : false @endphp
@include('admin.layouts.scripts.dzSingleImageField', [
    'record' => isset($website) ? $website : '',
    'hasMedia' => $hasAvatar,
    'previewUrl' => $hasAvatar ? $website->avatarUrl['250'] : route('images_default',['resolution' => '250x250']),
    'mediaUuid' => $hasAvatar ? $website->getFirstMedia('avatar')->uuid ?? '' : '',
    'fieldName' => 'avatar',
    'elementId' => 'user_avatar',
    'placeHolderText' => "Drop/Select Image<br/>(Max: 1 MB)"
])
<!-- Submit Field -->
<div class="form-group col-sm-12">
    <button class="btn btn-primary rspSuccessBtns" type="submit"><i class="fa-duotone fa-floppy-disk"></i> Save
    </button>
    <a href="{{ route('admin.websites.index') }}" class="btn btn-outline-danger">
        <i class="fa-duotone fa-arrow-left-to-line"></i> Back</a>
</div>
@push('stackedScripts')
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')
    <script>
        Dropzone.autoDiscover = false;
        uploadImageByDropzone('#user_avatar');
        let instance = 'editor';
        $('.submitsByAjax').submit(function (e) {
            e.preventDefault();
            let type = '';
            if (CKEDITOR.instances[instance]) {
                CKEDITOR.instances[instance].updateElement();
            }
            let dataToPass = new FormData($(this)[0]);
            ajaxCallFormSubmit($(this), false, 'Loading! Please wait...', dataToPass,
                type === 'create' ? postCreate : undefined);
        });

        function postCreate() {
            switch_between_register_to_registerAnother_btn($('.submitsByAjax'), false)
        }
    </script>
@endpush
