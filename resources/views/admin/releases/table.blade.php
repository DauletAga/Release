<div class="table-responsive">
    <table class="table table-sm table-hover table-nowrap card-table">
        <thead>
        <tr class="tr-table">
            <th>
                <x-admin.checkbox-all/>
            </th>
            <th>ID</th>
            <th>Название</th>
            <th>Проект</th>
            <th>Автор</th>
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
                    {{ data_get($item, \App\Contracts\ReleaseContract::FIELD_ID) }}
                </td>
                <td>
                    {{ data_get($item, \App\Contracts\ReleaseContract::FIELD_NAME) }}
                </td>
                <td>
                    {{ data_get($item->project, \App\Contracts\ProjectContract::FIELD_NAME) }}
                </td>
                <td>
                    {{ data_get($item->author, \App\Contracts\UserContract::LOCAL_NAME) }}
                </td>
                <x-admin.edit-icon :item="$item" :model="$model"/>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
