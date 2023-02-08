<div class="form-group">
    <label class="form-label mb-1">{{ $title }}</label>
    <select name="{{ $name }}" class="form-select" data-choices>

        @if(!isset($hidden_empty))
            <option value="">-</option>
        @endif

        @foreach($list as $item)
            <option @if((isset($row) && $row[$name] == $item->id) || request($name) == $item->id || old($name) == $item->id) selected @endif value="{{$item->id}}">
                {{$item->name}}
            </option>
        @endforeach
    </select>
</div>
