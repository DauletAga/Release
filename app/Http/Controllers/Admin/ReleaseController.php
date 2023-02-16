<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\ProjectContract;
use App\Contracts\ReleaseContract;
use App\Contracts\ReleaseTagContract;
use App\Contracts\ReleaseUserContract;
use App\Contracts\UserContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ReleaseRequest;
use App\Models\Project;
use App\Models\Release;
use App\Models\ReleaseTag;
use App\Models\ReleaseUser;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\View;

class ReleaseController extends BaseController
{
	public function __construct()
	{
		$this->middleware('admin');
		View::share('menu', 'releases');
		View::share('model', 'releases');
		View::share('base_model', 'Release');
		View::share('title', 'Релизы');
	}

	public function index()
    {
		$row = Release::query()
			->select(
                ReleaseContract::FIELD_ID,
                ReleaseContract::FIELD_NAME,
                ReleaseContract::FIELD_TEXT,
                ReleaseContract::FIELD_DATE,
                ReleaseContract::FIELD_PROJECT_ID,
                ReleaseContract::FIELD_AUTHOR_ID,
                ReleaseContract::FIELD_CREATED_AT,
            )
            ->with(
                [
                    'project' => function (BelongsTo $query) {
                        $query->select(
                            [
                                ProjectContract::FIELD_ID,
                                ProjectContract::FIELD_NAME
                            ]
                        );
                    },
                    'author' => function (BelongsTo $query) {
                        $query->select(
                            [
                                UserContract::FIELD_ID,
                                UserContract::FIELD_FIRST_NAME,
                                UserContract::FIELD_LAST_NAME,
                            ]
                        );
                    },
                ]
            )
            ->type()
            ->order()
            ->searchByName()
			->paginate(20);

		return view('admin.general.list', [
			'row' => $row
		]);
    }

	public function create()
	{
		return view('admin.general.edit', [
			'action' => route('admin.releases.store'),
            'projects' => Project::getProjectList(),
            'tags' => Tag::getTagList(),
            'users' => User::getUserList(),
		]);
	}

	public function store(ReleaseRequest $request)
	{
        $data = $request->validated();
        $data = array_merge(
            $data,
            [
                ReleaseContract::FIELD_AUTHOR_ID => auth()->id(),
                ReleaseContract::FIELD_DATE => Carbon::parse(data_get($request, ReleaseContract::FIELD_DATE))
            ]
        );
		$release = Release::query()->create($data);

        $release->tags()->attach(data_get($request, ReleaseContract::LIST_TAGS));

        $release->users()->attach(data_get($request, ReleaseContract::LIST_USERS));

        $project = Project::query()->findOrFail(data_get($data, ReleaseContract::FIELD_PROJECT_ID));
        $project->increment(ProjectContract::FIELD_UPDATE_COUNT);

		return redirect()->route('admin.releases.index');
	}

	public function edit(Release $release)
	{
        $user_ids = ReleaseUser::query()
            ->where(
                ReleaseUserContract::FIELD_RELEASE_ID,
                data_get($release, ReleaseContract::FIELD_ID)
            )
            ->pluck(ReleaseUserContract::FIELD_USER_ID)
        ;
        $release['user_ids[]'] = $user_ids;

        $tag_ids = ReleaseTag::query()
            ->where(
                ReleaseTagContract::FIELD_RELEASE_ID,
                data_get($release, ReleaseContract::FIELD_ID)
            )
            ->pluck(ReleaseTagContract::FIELD_TAG_ID)
        ;
        $release['tag_ids[]'] = $tag_ids;

        if (data_get($release, ReleaseContract::FIELD_DATE) == null)
        {
            $release[ReleaseContract::FIELD_DATE] = Carbon::now()->format('d.m.Y');
        } else {
            $release[ReleaseContract::FIELD_DATE] = Carbon::parse(data_get($release, ReleaseContract::FIELD_DATE))->format('d.m.Y');
        }

		return view('admin.general.edit', [
			'row' => $release,
			'action' => route('admin.releases.update', $release),
            'projects' => Project::getProjectList(),
            'tags' => Tag::getTagList(),
            'users' => User::getUserList(),
		]);
	}

	public function update(ReleaseRequest $request, Release $release)
	{
        $data = $request->validated();
        $data = array_merge(
            $data,
            [
                ReleaseContract::FIELD_DATE => Carbon::parse(data_get($request, ReleaseContract::FIELD_DATE))
            ]
        );
		$release->update($data);

        $release->tags()->sync(data_get($request, ReleaseContract::LIST_TAGS));

        $release->users()->sync(data_get($request, ReleaseContract::LIST_USERS));

		return redirect()->route('admin.releases.index');
	}

	public function destroy(Release $release)
	{
        $release->tags()->detach();
        $release->users()->detach();

		$release->delete();

		return $this->sendSuccess();
	}

}
