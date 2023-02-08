<div class="btn-group-toggle" style="margin-bottom: 20px">
    <div class="form-label mb-1">Теги</div>

    @if(isset($tags))
        @foreach($tags as $tag)
            <input type="checkbox" class="btn-check" name="tags[]" id="tag_{{ $tag->id }}" value="{{ $tag->id }}" autocomplete="off" @if(isset($row) && in_array($tag->id,$row->tags->pluck('id')->toArray())) checked="" @endif>
            <label class="btn btn-white" for="tag_{{ $tag->id }}">
                <i class="fe fe-check-circle"></i> {{ $tag->name }}
            </label>
        @endforeach
    @endif
</div>
