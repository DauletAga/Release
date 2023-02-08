<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Support\Facades\View;

class ProjectController extends BaseController
{
	public function __construct()
	{
		$this->middleware('admin');
		View::share('menu', 'projects');
		View::share('model', 'projects');
		View::share('base_model', 'Project');
		View::share('title', 'Проекты');
	}

	public function index()
    {
		$row = Project::query()
			->select('*')
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
			'action' => route('admin.projects.store'),
		]);
	}

	public function store(ProjectRequest $request)
	{
		Project::query()->create($request->all());
		return redirect()->route('admin.projects.index');
	}

	public function edit(Project $project)
	{
		return view('admin.general.edit', [
			'row' => $project,
			'action' => route('admin.projects.update', $project),
		]);
	}

	public function update(ProjectRequest $request, Project $project)
	{
		$project->update($request->all());
		return redirect()->route('admin.projects.index');
	}

	public function destroy(Project $project)
	{
		$project->delete();
		return $this->sendSuccess();
	}

}
