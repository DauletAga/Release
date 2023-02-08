@if(request('type') !== 'deleted')

    <td style="width: 150px">
        <a href="{{ route('admin.'.$model.'.edit', $item) }}">
            <span class="fe fe-edit" data-bs-toggle="tooltip" data-bs-original-title="Изменить"></span>
        </a>
        <a href="javascript:void(0);" onclick="delItem(this, '{{ $item->id }}', '{{$model}}')">
            <span style="color: red" class="fe fe-trash-2" data-bs-toggle="tooltip" data-bs-original-title="Удалить"></span>
        </a>
    </td>

@endif
