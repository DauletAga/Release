<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ReleaseController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;


Route::group([
    'excluded_middleware' => ['admin'],
    'middleware' => 'web',
    'as' => 'admin.'
], function () {
    Route::any('login', [ AuthController::class, 'login' ])->name('login');
    Route::any('logout', [ AuthController::class, 'logout' ])->name('logout');
});

Route::post('is-show/{model_name}', [BaseController::class,'changeIsShow'])->name('admin.is-show');
Route::post('restore/{model_name}', [BaseController::class,'restore'])->name('admin.restore');


Route::group([
	'middleware' => ['admin', 'auth', 'web'],
	'as' => 'admin.'
], function () {

	Route::resource('users', UserController::class);

	Route::resource('projects', ProjectController::class);

	Route::resource('tags', TagController::class);

	Route::resource('releases', ReleaseController::class);

    Route::delete('release-images', [ReleaseController::class, 'deleteImages']);
});
