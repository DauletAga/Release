<h2 class="header-title">
    SEO оптимизация
</h2>
<br>
<div class="form-group">
    <label class="form-label">Title</label>
    <input type="text" class="form-control" name="title" value="{{ $row->title ?? old('title') }}">
</div>
<div class="form-group">
    <label class="form-label">Meta description</label>
    <textarea class="form-control" rows="4" name="meta_desc" type="text">{{ $row->meta_desc ?? old('meta_desc') }}</textarea>
</div>
<div class="form-group">
    <label class="form-label">Meta keywords</label>
    <textarea class="form-control" rows="4" name="keywords" type="text">{{ $row->keywords ?? old('keywords') }}</textarea>
</div>