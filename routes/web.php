<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('{any?}', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'media'
], function () {
    Route::get('modal', [MediaController::class,'showModal']);
    Route::post('upload', [MediaController::class,'uploadFile']);
    Route::get('{file_name}', [MediaController::class,'showMedia'])->where('file_name', '.*');
});

Route::group([
    'prefix' => 'file'
], function () {
    Route::get('multiple-modal', [FileController::class,'showMultipleModal']);
    Route::post('multiple-upload', [FileController::class,'storeMultipleFiles'])->name('file.multiple-upload');
    Route::delete('', [FileController::class,'destroy']);
});
