<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\View;

class TagController extends BaseController
{
	public function __construct()
	{
		$this->middleware('admin');
		View::share('menu', 'tags');
		View::share('model', 'tags');
		View::share('base_model', 'Tag');
		View::share('title', 'Тэги');
	}

	public function index()
    {
		$row = Tag::query()
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
			'action' => route('admin.tags.store'),
		]);
	}

	public function store(TagRequest $request)
	{
		Tag::query()->create($request->all());
		return redirect()->route('admin.tags.index');
	}

	public function edit(Tag $tag)
	{
		return view('admin.general.edit', [
			'row' => $tag,
			'action' => route('admin.tags.update', $tag),
		]);
	}

	public function update(TagRequest $request, Tag $tag)
	{
		$tag->update($request->all());
		return redirect()->route('admin.tags.index');
	}

	public function destroy(Tag $tag)
	{
		$tag->delete();
		return $this->sendSuccess();
	}

}
