<div class="form-group {{$divClass ?? ""}}">
    <label class="form-label">{{ $title }}</label>
    <input type="{{ $type }}" class="form-control {{$class ?? ""}}" name="{{ $name }}" value="{{ $row[$name] ?? old($name) }}" data-inputmask="{{$mask ?? ""}}" id="{{$id ?? ""}}" placeholder="{{ $placeholder ?? "" }}">
</div>
