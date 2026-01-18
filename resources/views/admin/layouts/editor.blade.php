@php
if(isset($editorId) && $editorId != ''){
    $id = $editorId;
}else{
    $id = 'editor';
}

if(isset($editorFieldName) && $editorFieldName != ''){
    $fieldName = $editorFieldName;
}else{
    $fieldName = 'description';
}
if(isset($editorFieldLabelName) && $editorFieldLabelName != ''){
    $fieldLableName = $editorFieldLabelName;
}else{
    $fieldLableName = 'Description';
}

@endphp

<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label($fieldName, $fieldLableName) !!}
    {!! Form::textarea($fieldName, null, ['class' => 'form-control', 'id' => $id]) !!}
</div>
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
@push('stackedScripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>

        CKEDITOR.replace('{{ $id }}', {
            filebrowserImageBrowseUrl: '/file-manager/ckeditor',
        })
    </script>

@endpush
