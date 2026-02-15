<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Client Name']) !!}
</div>

<!-- Role Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role', 'Role (Title/Company/Location):') !!}
    {!! Form::text('role', null, ['class' => 'form-control', 'placeholder' => 'e.g. CEO at Tech / Verified Customer / New York']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12">
    {!! Form::label('content', 'Testimonial Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Enter the feedback content', 'rows' => 4]) !!}
</div>

<!-- Avatar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Client Avatar:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('image', ['class' => 'custom-file-input', 'id' => 'avatar_input', 'accept' => 'image/*']) !!}
            {!! Form::label('image', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
    @if(isset($testimonial))
        <div class="mt-2">
            <img src="{{ $testimonial->avatar_url }}" alt="Avatar" class="img-thumbnail" style="width: 80px; height: 80px; object-cover;">
        </div>
    @endif
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <div class="form-check">
        {!! Form::hidden('status', 0) !!}
        {!! Form::checkbox('status', 1, null, ['class' => 'form-check-input', 'data-bootstrap-switch']) !!}
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 fields_footer_action_buttons">
    <button class="btn btn-primary rspSuccessBtns" type="submit" id="submit_btn"><i class="fa-duotone fa-floppy-disk"></i> Save</button>
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-danger"><i class="fa-duotone fa-arrow-left-to-line"></i> Back</a>
</div>

@push('stackedScripts')
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')
    <script>
        $(document).ready(function() {
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
        });
    </script>
@endpush
