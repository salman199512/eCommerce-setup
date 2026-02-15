<div class="table-responsive">
    {!! $dataTable->table(['width' => '100%', 'class' => 'table table-bordered table-striped']) !!}
</div>

@push('stackedScripts')
    {!! $dataTable->scripts() !!}
@endpush
