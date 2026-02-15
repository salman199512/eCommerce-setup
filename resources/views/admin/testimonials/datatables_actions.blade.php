<div class='btn-group'>
    <a href="{{ route('admin.testimonials.edit', $uuid) }}" class='btn btn-outline-primary btn-xs mr-1 p-1 pr-2 pl-2'>
        <i class="fa-duotone fa-pen-to-square"></i>
    </a>
    {!! Form::button('<i class="fa-duotone fa-trash-can"></i>', [
        'type' => 'button',
        'class' => 'btn btn-outline-danger btn-xs p-1 pr-2 pl-2',
        'onclick' => "delete_btn_ajax('".route('admin.testimonials.destroy', $uuid)."', 'Testimonial deleted successfully', 'dataTableBuilder')"
    ]) !!}
</div>
