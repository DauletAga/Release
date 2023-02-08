<div class="form-group">
    <label class="form-label mb-1">{{ $title }}</label>
    <textarea class="form-control" name="{{$name}}">{{ $row[$name] ?? old($name) }}</textarea>
</div>
