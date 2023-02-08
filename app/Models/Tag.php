<?php

namespace App\Models;

use App\Contracts\TagContract;
use App\Http\Traits\FilterTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends BasicModel
{
	use SoftDeletes;
	use FilterTrait;

    protected $guarded = [];

    public static function getTagList(): Object
    {
        return Tag::query()
            ->select(
                TagContract::FIELD_ID,
                TagContract::FIELD_NAME
            )
            ->orderBy(
                TagContract::FIELD_NAME
            )
            ->get();
    }
}
