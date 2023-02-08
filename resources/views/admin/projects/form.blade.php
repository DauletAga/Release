<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">

                <x-admin.form.upload-image :row="$row ?? null" title="Аватар" type="img" name="image"/>

                <div class="row">
                    <div class="col-12 col-md-6">
                       <x-admin.form.input :row="$row ?? null" title="Название" type="text" name="name"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
