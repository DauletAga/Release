<div class="row align-items-center">
    <div class="col">
        <ul class="nav nav-tabs nav-overflow header-tabs">
            <li class="nav-item">
                <a href="{{route('admin.' . $model . '.index',['parent_id' => request()->parent_id])}}" class="nav-link text-nowrap @if(request()->type != 'deleted' && request()->type != 'inactive') active @endif">
                    Активные <span style="color: green" class="badge rounded-pill bg-secondary-soft"><span class="fe fe-check-circle"></span></span>
                </a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a href="{{route('admin.' . $model . '.index',['type' => 'inactive', 'parent_id' => request()->parent_id])}}" class="nav-link text-nowrap @if(request()->type == 'inactive') active @endif">--}}
{{--                    Неактивные <span style="color: orange" class="badge rounded-pill bg-secondary-soft"><span class="fe fe-alert-circle"></span>--}}
{{--                    </span>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li class="nav-item">
                <a href="{{route('admin.' . $model . '.index',['type' => 'deleted', 'parent_id' => request()->parent_id])}}" class="nav-link text-nowrap @if(request()->type == 'deleted') active @endif">
                    Удаленные <span style="color: red" class="badge rounded-pill bg-secondary-soft"><span class="fe fe-x-circle"></span></span>
                </a>
            </li>
        </ul>
    </div>
</div>
