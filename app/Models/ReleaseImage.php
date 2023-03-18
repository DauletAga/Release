<?php

namespace App\Models;

use App\Http\Traits\FilterTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReleaseImage extends BasicModel
{
    use FilterTrait;
    use SoftDeletes;

    protected $guarded    = [];
}
