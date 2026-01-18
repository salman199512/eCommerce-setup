<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'required', 'id' => 'slug_text']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'required', 'id' => 'slug']) !!}
</div>


<!-- Description Field -->
@include('admin.layouts.editor',
[
    'editorId' => 'editor',
    'editorFieldName' => 'description',
    'editorFieldLabelName' => 'Description',
])

<!-- Meta Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('meta_title', 'Meta Title:') !!}
    {!! Form::text('meta_title', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Meta Keyword Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('meta_keyword', 'Meta Keyword:') !!}
    {!! Form::textarea('meta_keyword', null, ['class' => 'form-control', 'rows' => '3']) !!}
</div>

<!-- Meta Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('meta_description', 'Meta Description:') !!}
    {!! Form::textarea('meta_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    <button class="btn btn-primary rspSuccessBtns" type="submit"><i class="fa-duotone fa-floppy-disk"></i> Save
    </button>
    <a href="{{ route('admin.contentManagements.index') }}" class="btn btn-outline-danger">
        <i class="fa-duotone fa-arrow-left-to-line"></i> Back</a>
</div>
@push('stackedScripts')
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')
    <script>
        let instance = 'editor';
        $('.submitsByAjax').submit(function (e) {
            e.preventDefault();
            let type = ''
            if (CKEDITOR.instances[instance]) {
                CKEDITOR.instances[instance].updateElement();
            }
            let dataToPass = new FormData($(this)[0]);
            ajaxCallFormSubmit($(this), false, 'Loading! Please wait...', dataToPass,
                type === 'create' ? postCreate : undefined);
        });

        function postCreate(){
            switch_between_register_to_registerAnother_btn($('.submitsByAjax'), false)
        }
    </script>
@endpush
