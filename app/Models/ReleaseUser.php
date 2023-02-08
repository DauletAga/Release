<?php

namespace App\Models;

use App\Contracts\ReleaseUserContract;
use App\Http\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReleaseUser extends BasicModel
{
	use SoftDeletes;
	use FilterTrait;

    protected $table = ReleaseUserContract::TABLE_NAME;
    protected $guarded = [];

    public function release(): BelongsTo
    {
        return $this->BelongsTo(Release::class);
    }

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
