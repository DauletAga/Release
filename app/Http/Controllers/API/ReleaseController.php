<?php

namespace App\Http\Controllers\API;

use App\Contracts\ProjectContract;
use App\Contracts\ReleaseContract;
use App\Contracts\ReleaseImageContract;
use App\Contracts\ReleaseTagContract;
use App\Contracts\TagContract;
use App\Contracts\UserContract;
use App\Models\Project;
use App\Models\Release;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ReleaseController extends AppBaseController
{
    private int $per_page = 20;

    public function index(Request $request): JsonResponse
    {
        $per_page = $request->get('per_page') ?: $this->per_page;

        $releases = Release::query()
            ->select(
                [
                    ReleaseContract::FIELD_ID,
                    ReleaseContract::FIELD_PROJECT_ID,
                    ReleaseContract::FIELD_NAME,
                    ReleaseContract::FIELD_DATE,
                ]
            )
            ->with(
                [
                    'users' => function (BelongsToMany $query) {
                        $query->select(
                            [
                                'users.' . UserContract::FIELD_ID,
                                UserContract::FIELD_FIRST_NAME,
                                UserContract::FIELD_LAST_NAME,
                                UserContract::FIELD_AVATAR,
                            ]
                        );
                    },
                    'tags' => function (BelongsToMany $query){
                        $query->select(
                            [
                                'tags.' . TagContract::FIELD_ID,
                                TagContract::FIELD_NAME,
                            ]
                        );
                    },
                    'project' => function (BelongsTo $query) {
                        $query->select(
                            [
                                ProjectContract::FIELD_ID,
                                ProjectContract::FIELD_NAME,
                                ProjectContract::FIELD_UPDATE_COUNT,
                                ProjectContract::FIELD_VERSION_COUNT,
                            ]
                        );
                    },
                ]
            )
            ->when(
                $request->has('tag_id'),
                function ($query) use ($request) {
                    $query->whereHas(
                            'tags', function ($query) use ($request){
                            $query->where(
                                ReleaseTagContract::FIELD_TAG_ID,
                                $request->get('tag_id')
                            );
                        }
                    );
                }
            )
            ->when(
                $request->has('project_id'),
                function ($query) use ($request) {
                    $query->where(
                        ReleaseContract::FIELD_PROJECT_ID,
                        $request->get('project_id')
                    );
                }
            )
            ->when(
                $request->has('date_from'),
                function ($query) use ($request) {
                    $query->whereDate(
                        ReleaseContract::FIELD_DATE,
                        '>=',
                        Carbon::parse($request->get('date_from'))
                    );
                }
            )
            ->when(
                $request->has('date_to'),
                function ($query) use ($request) {
                    $query->whereDate(
                        ReleaseContract::FIELD_DATE,
                        '<=',
                        Carbon::parse($request->get('date_to'))
                    );
                }
            )
            ->order()
            ->searchByName()
            ->orderBy(
                ReleaseContract::FIELD_CREATED_AT
            )
            ->paginate($per_page);

        $project = [];
        if ($request->has(ReleaseContract::FIELD_PROJECT_ID))
        {
            $project = Project::query()
                ->select(
                    [
                        ProjectContract::FIELD_ID,
                        ProjectContract::FIELD_NAME,
                        ProjectContract::FIELD_VERSION_COUNT,
                        ProjectContract::FIELD_UPDATE_COUNT,
                    ]
                )
                ->where(
                    ProjectContract::FIELD_ID,
                    $request->get(ReleaseContract::FIELD_PROJECT_ID)
                )
                ->get()
            ;
        }

        $releaseCollection = collect($releases->items());
        $releaseCollection = $releaseCollection
            ->map(function ($item){
                return [
                    'id' => data_get($item, ReleaseContract::FIELD_ID),
                    'name' => data_get($item, ReleaseContract::FIELD_NAME),
                    'date' => Carbon::parse(data_get($item, ReleaseContract::FIELD_DATE))->format('d.m.Y'),
                    'tags' => $item->tags->map(function ($tag){
                        return [
                            'id' => data_get($tag, TagContract::FIELD_ID),
                            'name' => data_get($tag, TagContract::FIELD_NAME),
                        ];
                    }),
                    'users' => $item->users->map(function ($user){
                        return [
                            'id' => data_get($user, UserContract::FIELD_ID),
                            'name' => data_get($user, UserContract::LOCAL_NAME),
                            'avatar' => data_get($user, UserContract::FIELD_AVATAR) ? config('urls.app_url') . data_get($user, UserContract::FIELD_AVATAR) : '',
                        ];
                    }),
                ];
            });

        return $this->sendResponse(
            [
                'releases' => $releaseCollection,
                'project' => $project,
                'hasNext'     => $releases->hasMorePages(),
                'currentPage' => $releases->currentPage(),
                'lastPage'    => $releases->lastPage(),
            ]
        );
    }

    public function show($id): JsonResponse
    {
        $release = Release::query()
            ->select(
                [
                    ReleaseContract::FIELD_ID,
                    ReleaseContract::FIELD_NAME,
                    ReleaseContract::FIELD_TEXT,
                    ReleaseContract::FIELD_DATE,
                    ReleaseContract::FIELD_PROJECT_ID,
                ]
            )
            ->with(
                [
                    'users' => function (BelongsToMany $query) {
                        $query->select(
                            [
                                'users.' . UserContract::FIELD_ID,
                                UserContract::FIELD_FIRST_NAME,
                                UserContract::FIELD_LAST_NAME,
                                UserContract::FIELD_AVATAR,
                            ]
                        );
                    },
                    'tags' => function (BelongsToMany $query){
                        $query->select(
                            [
                                'tags.' . TagContract::FIELD_ID,
                                TagContract::FIELD_NAME,
                            ]
                        );
                    },
                    'project' => function (BelongsTo $query) {
                        $query->select(
                            [
                                ProjectContract::FIELD_ID,
                                ProjectContract::FIELD_NAME,
                            ]
                        );
                    },
                    'images' => function (HasMany $query) {
                        $query->select(
                            [
                                ReleaseImageContract::FIELD_RELEASE_ID,
                                ReleaseImageContract::FIELD_IMAGE
                            ]
                        );
                    },
                ]
            )
            ->findOrFail($id);

        return $this->sendResponse(
            [
                'id' => data_get($release, ReleaseContract::FIELD_ID),
                'name' => data_get($release, ReleaseContract::FIELD_NAME),
                'text' => data_get($release, ReleaseContract::FIELD_TEXT),
                'date' => Carbon::parse(data_get($release, ReleaseContract::FIELD_DATE))->format('d.m.Y'),
                'tags' => $release->tags->map(function ($tag){
                    return [
                        'id' => data_get($tag, TagContract::FIELD_ID),
                        'name' => data_get($tag, TagContract::FIELD_NAME),
                    ];
                }),
                'users' => $release->users->map(function ($user){
                    return [
                        'id' => data_get($user, UserContract::FIELD_ID),
                        'name' => data_get($user, UserContract::LOCAL_NAME),
                        'avatar' => data_get($user, UserContract::FIELD_AVATAR) ? config('urls.app_url') . data_get($user, UserContract::FIELD_AVATAR) : '',
                    ];
                }),
                'gallery' =>
                    $release->images->map(function ($image) {
                        return data_get($image, ProjectContract::FIELD_IMAGE) ?
                            config('urls.app_url') . data_get($image, ProjectContract::FIELD_IMAGE) : '';
                    }),
                'project_name' => data_get($release->project, ProjectContract::FIELD_NAME)
            ]
        );
    }

}
