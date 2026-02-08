<div class="table-responsive">
    {!! $dataTable->table(['width' => '100%', 'class' => 'table table-hover']) !!}
</div>

@push('stackedScripts')
    @include('admin.layouts.datatables_css')
    @include('admin.layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endpush
