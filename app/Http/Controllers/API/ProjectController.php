<?php

namespace App\Http\Controllers\API;

use App\Contracts\ProjectContract;
use App\Models\Project;
use Illuminate\Http\JsonResponse;


class ProjectController extends AppBaseController
{
    public function index(): JsonResponse
    {
        $project = Project::query()
            ->select(
                [
                    ProjectContract::FIELD_ID,
                    ProjectContract::FIELD_NAME,
                    ProjectContract::FIELD_IMAGE,
                    ProjectContract::FIELD_UPDATE_COUNT,
                    ProjectContract::FIELD_VERSION_COUNT,
                ]
            )
            ->searchByName()
            ->get()
            ->map(function ($item){
                return [
                    'id' => data_get($item, ProjectContract::FIELD_ID),
                    'name' => data_get($item, ProjectContract::FIELD_NAME),
                    'image' => data_get($item, ProjectContract::FIELD_IMAGE) ? config('urls.app_url') . data_get($item, ProjectContract::FIELD_IMAGE) : '',
                    'update_count' => data_get($item, ProjectContract::FIELD_UPDATE_COUNT),
                    'version_count' => data_get($item, ProjectContract::FIELD_VERSION_COUNT),
                ];
            });

        return $this->sendResponse(
            [
                'project' => $project,
            ]
        );
    }
}
