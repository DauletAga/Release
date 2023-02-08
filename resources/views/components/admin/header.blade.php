<div class="row align-items-center">
    <div class="col">
        <h6 class="header-pretitle">
            Admin Panel
        </h6>
        <h1 class="header-title text-truncate">
            {{ $title }}
        </h1>
    </div>
    <div class="col-auto">
        <a @if(isset($ajax)) onclick="showEditModal('{{$model}}',0)" href="javascript:void(0)" @else href="{{ $action }}" @endif class="btn btn-primary ms-2">
            Добавить
        </a>
    </div>
</div>
