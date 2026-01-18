
<!-- Question English Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question_english', 'Question:') !!}
    {!! Form::text('question_english', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Answer Gujarati Field -->



@include('admin.layouts.editor',
[
    'editorId' => 'answer_english',
    'editorFieldName' => 'answer_english',
    'editorFieldLabelName' => 'Answer ',
])

<!-- Answer Hindi Field -->


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <button class="btn btn-primary rspSuccessBtns" type="submit"><i class="fa-duotone fa-floppy-disk"></i> Save
    </button>
    <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-danger">
        <i class="fa-duotone fa-arrow-left-to-line"></i> Back</a>
</div>
@push('stackedScripts')
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')
    <script>
        let instance = 'answer_gujarati';
        let instance2 = 'answer_english';
        let instance1 = 'answer_hindi';

        $('.submitsByAjax').submit(function (e) {
            e.preventDefault();
            let type = ''
            if (CKEDITOR.instances[instance]) {
                CKEDITOR.instances[instance].updateElement();
            }
            if (CKEDITOR.instances[instance2]) {
                CKEDITOR.instances[instance2].updateElement();
            }
            if (CKEDITOR.instances[instance1]) {
                CKEDITOR.instances[instance1].updateElement();
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
