<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Title', 'id' => 'master_title']) !!}
</div>

{!! Form::hidden('slug', null, ['id' => 'master_slug']) !!}

<!-- Meta Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('meta_title', 'Meta Title:') !!}
    {!! Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Meta Title', 'id' => 'master_meta_title']) !!}
</div>

<!-- Meta Keywords Field -->
<div class="form-group col-sm-6">
    {!! Form::label('meta_keywords', 'Meta Keywords:') !!}
    {!! Form::textarea('meta_keywords', null, ['class' => 'form-control', 'placeholder' => 'Enter Meta Keywords', 'rows' => 2]) !!}
</div>

<!-- Meta Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('meta_description', 'Meta Description:') !!}
    {!! Form::textarea('meta_description', null, ['class' => 'form-control', 'placeholder' => 'Enter Meta Description', 'rows' => 3]) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-md-12 fields_footer_action_buttons">
    <button class="btn btn-primary rspSuccessBtns" type="submit" ><i class="fa-duotone fa-floppy-disk"></i> Save</button>
    <a href="{{ route('admin.categories.index') }}" class="btn  btn-outline-danger"><i class="fa-duotone fa-arrow-left-to-line"></i> Back</a>
</div>

@push('stackedScripts')
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')

    <script>
        $('#master_title').on('input', function() {
            let title = $(this).val();
            let slug = title.toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
            $('#master_slug').val(slug);
            $('#master_meta_title').val(title);
        });

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
