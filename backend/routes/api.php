<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/***add link */
use App\Http\Controllers\userController;
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

Route::group(['prefix' => '/user_made'], function () {
    Route::get('/',[userController::class,'get_all']);
    Route::post('/',[userController::class,'create']);
    Route::put('/{id}',[userController::class,'update']);
    Route::delete('/{id}',[userController::class,'destroy']);
    Route::get('/findbyid/{id}',[userController::class,'find_by_id']);
    Route::get('/search/{champ_search}',[userController::class,'search']);
});
