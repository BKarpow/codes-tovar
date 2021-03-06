<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/code')->group(function () {

    Route::get('/search', [App\Http\Controllers\CodeController::class, 'search']);
    Route::get('/dump', [App\Http\Controllers\CodeController::class, 'getDataDumpAsJson']);
    Route::get('/group', [App\Http\Controllers\CodeController::class, 'getNameGroupsAndCount']);
    Route::post('/from', [App\Http\Controllers\CodeController::class, 'getCodesFromGroup']);
});
