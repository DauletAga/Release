<?php


namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;


abstract class BasicModel extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Builder|$this|Builder
     */
    public static function query()
    {
        return parent::query();
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('d.m.Y H:i')
        );
    }
}
