<?php

namespace App\Models;

use App\Contracts\ReleaseContract;
use App\Contracts\ReleaseImageContract;
use App\Http\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Release extends BasicModel
{
	use SoftDeletes;
	use FilterTrait;

    protected $guarded = [];

    public function project(): BelongsTo
    {
        return $this->BelongsTo(Project::class);
    }

    public function author(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->BelongsToMany(Tag::class)->withTimestamps();
    }

    public function users(): BelongsToMany
    {
        return $this->BelongsToMany(User::class)->withTimestamps();
    }

    public function images(): HasMany
    {
        return $this->HasMany(
            ReleaseImage::class,
            ReleaseImageContract::FIELD_RELEASE_ID,
            ReleaseContract::FIELD_ID,
        );
    }
}
