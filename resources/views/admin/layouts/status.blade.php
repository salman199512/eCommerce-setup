

<label class="switch">
    <input type="checkbox" name="active" {{$status ?? ''}} onclick="ajaxCallChangeStatus('{{ $urlStatus ?? '' }}','{{ $alert ?? '' }}', '{{ $tableId ?? '' }}')">
    <span class="slider round"></span>
</label>
