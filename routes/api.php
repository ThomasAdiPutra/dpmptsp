<?php

use App\Http\Controllers\NewsController;
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
Route::group(['middleware' => 'auth:web'], function () {
    Route::get('berita', [NewsController::class, 'getAllNews'])->name('api.berita.index');
    Route::get('berita/active/{beritum}', [NewsController::class, 'toggleActive'])->name('api.berita.toggleActive');
});
