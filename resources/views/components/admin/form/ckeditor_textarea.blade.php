<div class="form-group">
    <label class="form-label mb-1">{{ $title }}</label>
    <textarea name="{{ $name }}" class="ckeditor form-control text_editor">{{ $row[$name] ?? old($name) }}</textarea>
</div>
