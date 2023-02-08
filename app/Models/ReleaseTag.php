<?php

namespace App\Models;

use App\Contracts\ReleaseTagContract;
use App\Http\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReleaseTag extends BasicModel
{
	use SoftDeletes;
	use FilterTrait;

    protected $table = ReleaseTagContract::TABLE_NAME;
    protected $guarded = [];

    public function release(): BelongsTo
    {
        return $this->BelongsTo(Release::class);
    }

    public function tag(): BelongsTo
    {
        return $this->BelongsTo(Tag::class);
    }
}
