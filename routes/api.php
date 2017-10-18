<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("bbox/head_check_server_connection", "bbox@head_check_server_connection");
Route::get("bbox/get_server_token", "bbox@get_server_token");
Route::get("bbox/get_card", "bbox@get_card")->middleware("CheckServerToken");
Route::get("bbox/get_foodbox", "bbox@get_foodbox")->middleware("CheckServerToken");

Route::put("bbox/put_feeding_log", "bbox@put_feeding_log")->middleware("CheckServerToken");
Route::put("bbox/put_foodbox", "bbox@put_foodbox")->middleware("CheckServerToken");
