<div class="list-alert alert alert-dark alert-dismissible border fade" id="action" role="alert">
    <div class="row align-items-center">
        <div class="col">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="cardAlertCheckbox" checked disabled>
                <label class="form-check-label text-white" for="cardAlertCheckbox">
                    <span class="selected_item_count">0</span> выбрано
                </label>
            </div>
        </div>
        <div class="col-auto me-n3">
            @if(request()->type != 'deleted')
                @if(request()->type == 'inactive')
                    <button class="btn btn-sm btn-white-20" onclick="isShowEnabled('{{$base_model}}',1)">
                        Сделать активным
                    </button>
                @else
                    <button class="btn btn-sm btn-white-20" onclick="isShowDisabled('{{$base_model}}',0)">
                        Сделать неактивным
                    </button>
                @endif
                <button class="btn btn-sm btn-white-20" onclick="deleteCheckedItem('{{$model}}')">
                    Удалить
                </button>
            @else
                <button class="btn btn-sm btn-white-20" onclick="restoreCheckedItem('{{$base_model}}')">
                    Восстановить
                </button>
            @endif
        </div>
    </div>
    <button type="button" class="list-alert-close btn-close" aria-label="Close"></button>
</div>