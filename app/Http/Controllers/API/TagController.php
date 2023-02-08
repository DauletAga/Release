<?php

namespace App\Http\Controllers\API;

use App\Contracts\TagContract;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;


class TagController extends AppBaseController
{
    public function index(): JsonResponse
    {
        $tags = Tag::query()
            ->select(
                [
                    TagContract::FIELD_ID,
                    TagContract::FIELD_NAME,
                ]
            )
            ->searchByName()
            ->get()
            ->map(function ($item){
                return [
                    'id' => data_get($item, TagContract::FIELD_ID),
                    'name' => data_get($item, TagContract::FIELD_NAME),
                ];
            });

        return $this->sendResponse(
            [
                'tags' => $tags,
            ]
        );
    }
}
