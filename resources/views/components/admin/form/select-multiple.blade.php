<div class="form-group {{$divClass ?? ""}}">
    <label class="form-label mb-1">{{ $title }}</label>
    <select name="{{ $name }}" @if(isset($id) && $id !== '') id="{{ $id }}" @endif
    class="form-control" data-choices='{"removeItemButton": true}' @if(isset($onchange) && $onchange !== '')
            onchange="{{ $onchange }}" @endif  multiple>

        @if(!isset($hidden_empty))
            <option value="">Выберите</option>
        @endif

        @foreach($list as $key => $item)
            <option
                @if((isset($row) && !$row[$name]->isEmpty() && in_array($item->id, $row[$name]->toArray())) || request($name) == $item->id || old($name) == $item->id) selected
                @endif value="{{$item->id}}">
                {{$item->name}}
            </option>
        @endforeach
    </select>
</div>
