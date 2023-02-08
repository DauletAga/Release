<div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$title}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display: none" role="alert"></div>

                    <input type="hidden" value="{{isset($row)?$row->id:0}}" name="id">

                    @include('admin.'.$model.'.edit-modal-content')

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" onclick="saveModal(this,'{{$model}}')">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>


