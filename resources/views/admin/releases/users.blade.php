<div class="btn-group-toggle" style="margin-bottom: 20px">
    <div class="form-label mb-1">Участники</div>

    @if(isset($users))
        @foreach($users as $user)
            <input type="checkbox" class="btn-check" name="users[]" id="user_{{ $user->id }}" value="{{ $user->id }}" autocomplete="off" @if(isset($row) && in_array($user->id,$row->users->pluck('id')->toArray())) checked="" @endif>
            <label class="btn btn-white" for="user_{{ $user->id }}">
                <i class="fe fe-check-circle"></i> {{ $user->name }}
            </label>
        @endforeach
    @endif
</div>
