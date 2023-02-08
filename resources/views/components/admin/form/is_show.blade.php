<div class="form-group">
    <label class="form-label mb-1">Статус</label>

    <select class="form-select" name="is_show">
        <option @if((isset($row) && $row->is_show == 1)) selected @endif value="1">Активный</option>
        <option @if((isset($row) && $row->is_show == 0)) selected @endif value="0">Неактивный</option>
    </select>
</div>