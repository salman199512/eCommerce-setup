<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Title']) !!}
</div>

<!-- Subtitle Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subtitle', 'Subtitle:') !!}
    {!! Form::text('subtitle', null, ['class' => 'form-control', 'placeholder' => 'Enter Subtitle']) !!}
</div>

<!-- Position Field -->
<div class="form-group col-sm-6">
    {!! Form::label('position', 'Position:') !!}
    {!! Form::select('position', [
        'main' => 'Main Banner',
        'grid_1' => 'Grid 1',
        'grid_2' => 'Grid 2',
        'footer' => 'Footer Banner'
    ], null, ['class' => 'form-control select2']) !!}
</div>

<!-- Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link', 'Link:') !!}
    {!! Form::text('link', null, ['class' => 'form-control', 'placeholder' => 'Enter Link']) !!}
</div>

<!-- Sort Order Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sort_order', 'Sort Order:') !!}
    {!! Form::number('sort_order', null, ['class' => 'form-control', 'placeholder' => 'Enter Sort Order']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <div class="form-check form-switch mt-2">
        {!! Form::hidden('status', 0) !!}
        {!! Form::checkbox('status', 1, null, ['class' => 'form-check-input', 'id' => 'status']) !!}
        <label class="form-check-label" for="status">Active</label>
    </div>
</div>

<!-- Image Field -->
<div class="form-group col-sm-12">
    {!! Form::label('image', 'Banner Image:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('image', ['class' => 'custom-file-input', 'id' => 'image', 'accept' => 'image/*']) !!}
        </div>
    </div>
    @if(isset($banner) && $banner->hasMedia('banner_images'))
        <div class="mt-2 text-center">
            <img src="{{ $banner->getFirstMediaUrl('banner_images') }}" alt="current image" style="max-width: 200px;">
        </div>
    @endif
</div>

<!-- Submit Field -->
<div class="form-group col-md-12 fields_footer_action_buttons mt-4">
    <button class="btn btn-primary rspSuccessBtns" type="submit" ><i class="fa-duotone fa-floppy-disk"></i> Save</button>
    <a href="{{ route('admin.banners.index') }}" class="btn  btn-outline-danger"><i class="fa-duotone fa-arrow-left-to-line"></i> Back</a>
</div>

@push('stackedScripts')
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')

    <script>
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
