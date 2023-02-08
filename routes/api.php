<?php

use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\ReleaseController;
use App\Http\Controllers\API\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return $request->user();
});

Route::get('/projects', [ProjectController::class, 'index']);

Route::get('/tags', [TagController::class, 'index']);

Route::get('/releases', [ReleaseController::class, 'index']);
Route::get('/releases/{id}', [ReleaseController::class, 'show']);
