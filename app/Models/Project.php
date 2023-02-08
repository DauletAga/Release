<?php

namespace App\Models;

use App\Contracts\ProjectContract;
use App\Http\Traits\FilterTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends BasicModel
{
	use SoftDeletes;
	use FilterTrait;

    protected $guarded = [];

    public static function getProjectList(): Object
    {
        return Project::query()
            ->select(
                ProjectContract::FIELD_ID,
                ProjectContract::FIELD_NAME,
            )
            ->orderBy(
                ProjectContract::FIELD_NAME
            )
            ->get();
    }
}
