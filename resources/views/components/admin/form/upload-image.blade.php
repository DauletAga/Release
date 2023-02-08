 <div class="row justify-content-between align-items-center">
    <div class="col-auto">
        <div class="row align-items-center">
            <div class="col-auto">
                <div class="avatar">
                    <img name="{{$name}}_src" class="avatar-img rounded-circle" src="{{ $row[$name] ?? old($name) }}" alt="...">
                    <input type="hidden" name="{{$name}}" value="{{ $row[$name] ?? old($name) }}">
                </div>
            </div>
            <div class="col ms-n2">
                <h4 class="mb-1">
                    {{$title}}
                </h4>
                <small class="text-muted">
                    PNG или JPG размером максимум 1мб
                </small>
            </div>
        </div>
    </div>
    <div class="col-auto">
        <button type="button" class="btn btn-sm btn-primary" onclick="showFileModal('{{$name}}','{{$type}}')">
            Загрузить
        </button>
    </div>
 </div>

 <hr class="my-5">
