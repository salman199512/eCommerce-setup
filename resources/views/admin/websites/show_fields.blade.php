<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $website->id }}</p>
</div>

<!-- Heading Field -->
<div class="col-sm-12">
    {!! Form::label('heading', 'Heading:') !!}
    <p>{{ $website->heading }}</p>
</div>

<!-- Sub Heading Field -->
<div class="col-sm-12">
    {!! Form::label('sub_heading', 'Sub Heading:') !!}
    <p>{{ $website->sub_heading }}</p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $website->type }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $website->description }}</p>
</div>

<!-- Uuid Field -->
<div class="col-sm-12">
    {!! Form::label('uuid', 'Uuid:') !!}
    <p>{{ $website->uuid }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $website->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $website->updated_at }}</p>
</div>

