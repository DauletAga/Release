<div class="table-responsive">
    <table class="table table-sm table-hover table-nowrap card-table">
        <thead>
        <tr class="tr-table">
            <th>
                <x-admin.checkbox-all/>
            </th>
            <th>ID</th>
            <th>Фото</th>
            <th>Название</th>
            @if(request('type') !== 'deleted')
                <th>Действия</th>
            @endif
        </tr>
        </thead>
        <tbody class="list fs-base">
        @foreach($row as $item)
            <tr>
                <td>
                    <x-admin.checkbox-item :id="$item->id"/>
                </td>
                <td>
                    {{ data_get($item, \App\Contracts\ProjectContract::FIELD_ID) }}
                </td>
                <td>
                    <div class="avatar avatar-lg">
                        <img src="{{ data_get($item, \App\Contracts\ProjectContract::FIELD_IMAGE) }}" alt="..." class="avatar-img rounded-circle">
                    </div>
                </td>
                <td>
                    {{ data_get($item, \App\Contracts\ProjectContract::FIELD_NAME) }}
                </td>
                <x-admin.edit-icon :item="$item" :model="$model"/>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
