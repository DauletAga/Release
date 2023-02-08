<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\View;

class UserController extends BaseController
{
	public function __construct()
	{
		$this->middleware('admin');
		View::share('menu', 'users');
		View::share('model', 'users');
		View::share('base_model', 'User');
		View::share('title', 'Пользователи');
	}

	public function index()
    {
		$row = User::query()
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
			'action' => route('admin.users.store'),
		]);
	}

	public function store(UserRequest $request)
	{
		User::query()->create($request->all());
		return redirect()->route('admin.users.index');
	}

	public function edit(User $user)
	{
		return view('admin.general.edit', [
			'row' => $user,
			'action' => route('admin.users.update', $user),
		]);
	}

	public function update(UserRequest $request, User $user)
	{
		$user->update($request->all());
		return redirect()->route('admin.users.index');
	}

	public function destroy(User $user)
	{
		$user->delete();
		return $this->sendSuccess();
	}

}
