<?php

namespace App\Http\Traits;
use Illuminate\Database\Eloquent\Builder;

trait FilterTrait
{
    public function scopeSearchByName(Builder $model){
        $model
            ->when(
                request('name'),
                function ($query) {
                    $query->where(
                        'name',
                        'like',
                        '%' . request('name') . '%'
                    );
                }
            );
    }

	public function scopeOrder(Builder $model){
		$model
			->when(
				request('sort') == 'old',
				function ($query) {
					$query->orderByDesc('id');
				}
			)
			->when(
				request('sort') != 'old',
				function ($query) {
					$query->orderBy('id');
				}
			);
	}

    public function scopeType(Builder $model){
        $model->when(
                request('type') == 'deleted',
                function ($query) {
                    $query->onlyTrashed();
                }
            );
    }
}
