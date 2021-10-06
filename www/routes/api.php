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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('register', 'App\Http\Controllers\API\RegisterController@register')->middleware('checkReg');
Route::post('login', 'App\Http\Controllers\API\RegisterController@login')->middleware('checkLogin');
Route::post('logout', 'App\Http\Controllers\API\RegisterController@logout')->middleware('checkLogout');

Route::get('error/{msg_id}', 'App\Http\Controllers\API\RegisterController@error')->name('error');

Route::get('test', 'App\Http\Controllers\API\RegisterController@test')->middleware('checkToken');
//Route::middleware('auth:api')->group( function () {
//  Route::resource('products', 'API\ProductController');
//});

