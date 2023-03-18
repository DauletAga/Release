<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-8">

                        <x-admin.form.upload-multiple-images :row="$row ?? null" title="Выберите файлы" type="images"/>

                        @include('admin.releases.image-list')

                        <div id="images_cover"></div>

                        <x-admin.form.input :row="$row ?? null" title="Название" type="text" name="name"/>

                        <x-admin.form.ckeditor_textarea :row="$row ?? null" title="Текст" type="text" name="text"/>

                        <x-admin.form.input :row="$row ?? null" title="Дата" name="date" type="text" class="datetimepicker-input" id="date-format"/>

                        <x-admin.form.select :row="$row ?? null" :list="$projects ?? null" title="Проект" name="project_id"/>
                    </div>
                </div>

                @include('admin.releases.tags')

                @include('admin.releases.users')
            </div>
        </div>
    </div>
</div>

@push('script')
    <script src="{{ asset('/custom/moment/moment.js') }}"></script>
    <script src="{{ asset('/custom/js/bootstrap-material-datetimepicker.js') }}"></script>
    <script>

        $('#date-format').bootstrapMaterialDatePicker({
            time: false,
            format: 'DD.MM.YYYY',
            weekStart: 1,
            nowButton : true
        });

    </script>
@endpush
