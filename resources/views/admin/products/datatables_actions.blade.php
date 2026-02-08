<div class="d-flex align-items-center gap-2">
    <a href="{{ route('admin.products.edit', $uuid) }}" title="Edit" class="btn btn-sm btn-icon btn-ghost-primary rounded-circle">
        <i class="fa-duotone fa-pencil"></i>
    </a>
    <a href="javascript:void(0)" 
       onclick="ajaxCallDelete('{{ route('admin.products.destroy', $uuid) }}', 'Are you sure?', 'Product-index')" 
       title="Delete" 
       class="btn btn-sm btn-icon btn-ghost-danger rounded-circle">
        <i class="fa-duotone fa-trash-can"></i>
    </a>
</div>
