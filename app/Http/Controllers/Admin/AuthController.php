<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login()
    {
		if (isset(request()->email)){

			$validate = request()->validate([
				'email' => ['required'],
				'password' => ['required', 'min:5']
			]);

			if (!Auth::attempt($validate)){

				throw ValidationException::withMessages([
					'email' => 'Неправильный логин или пароль'
				]);
			}
		}

	    if (Auth::check()){
		    return redirect()->route('admin.users.index');
	    }

		return view('admin.auth.login');
    }

	public function logout()
	{
		Auth::logout();
		return redirect('/');
	}
}
