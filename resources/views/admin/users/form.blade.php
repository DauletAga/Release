<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">

                <x-admin.form.upload-image :row="$row ?? null" title="Аватар" type="img" name="avatar"/>

                <div class="row">
                    <div class="col-12 col-md-6">
                       <x-admin.form.input :row="$row ?? null" title="Имя" type="text" name="first_name"/>
                    </div>
                    <div class="col-12 col-md-6">
                        <x-admin.form.input :row="$row ?? null" title="Фамилия" type="text" name="last_name"/>
                    </div>
                    <div class="col-12">
                        <x-admin.form.input :row="$row ?? null" title="Почта" type="text" name="email"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        @if(empty($row))
            <div class="card">
                <div class="card-body">
                    <x-admin.form.input :row="$row ?? null" title="Пароль" name="password" type="password"/>
                </div>
            </div>
        @endif
    </div>
</div>
