@section('css')
    @include('admin.layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%', 'class' => 'table']) !!}

@push('stackedScripts')
    @include('admin.layouts.datatables_js')
    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function () {
            $(document).on('change', '.status-change', function () {
                let id = $(this).data('id');
                let url = '{{ route("admin.categories.status-change", ":id") }}';
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (data) {
                        toast('success', data.message);
                    }
                });
            });
        });
    </script>
@endpush
