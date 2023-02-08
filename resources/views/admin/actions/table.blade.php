<div class="table-responsive">
    <table class="table table-sm table-hover table-nowrap card-table">
        <thead>
        <tr class="tr-table">
            <th>
                <x-admin.checkbox-all/>
            </th>
            <th>ID</th>
            <th>Тип</th>
            <th>Пользователь</th>
            <th>Действие</th>
            <th>Модель</th>
            @if(request('type') !== 'deleted')
                <th colspan="2">Действия</th>
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
                    {{ $item->id }}
                </td>
                <td>
                    {{ $item->actionable_type }}
                </td>
                <td>
                    {{ $item->user->name }}
                </td>
                <td>
                    {{ $item->text }}
                </td>
                <td>
                    {{ $item->actionable->name }}
                </td>
                <td>
                    {{ $item->created_at }}
                </td>
                <x-admin.edit-icon :item="$item" :model="$model"/>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
