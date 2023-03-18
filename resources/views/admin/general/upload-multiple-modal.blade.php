<div class="modal fade" id="upload_media_modal" tabindex="-1" aria-labelledby="exampleModalLabel" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="upload_multiple_media" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Загрузить файлы</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display: none" role="alert"></div>
                    <div>
                        <input type="hidden" name="type" value="{{$type}}">
{{--                        <input type="hidden" value="{{$name}}" id="media_name" >--}}
                        <input type="file" name="files[]" onchange="uploadMedia(this)" id="multi_files" multiple="multiple">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $("#upload_multiple_media").submit(function(event) {
        uploadMultipleFileSubmit(this,event);
    });
</script>

