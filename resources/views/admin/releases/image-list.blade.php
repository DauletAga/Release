@if(isset($images) && $images != null)
    <div class="row align-items-center mb-2">
        @foreach($images as $key => $val)
            <div class="col-auto justify-content-center imageItem mb-4"
                 @if(isset($val['id']))
                    id="image_{{ $val['id'] }}"
                @endif
            >
                <input type="hidden"
                       name="images[]"
                       value="{{ $val['image'] }}">
                <!-- Avatar -->
                <div class="avatar-xxl">
                    <img src="{{ $val['path'] }}" alt="..." class="avatar-img rounded">
                </div>
                <a href="javascript:void(0)"
                   @if(isset($val['id']))
                   onclick="deleteGalleryImages({{ $val['id'] }},'release-images')"
                   @else
                   onclick="confirmDeleteImage(this)"
                   @endif
                   class="btn btn-sm btn-danger  d-block mt-2">
                    Удалить
                </a>
            </div>
        @endforeach
    </div>
    <hr class="my-2">

@endif
