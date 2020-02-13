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

//Route::apiResource('chickenFillet', 'ChickenFilletController');

Route::apiResource('chickenFilletShop', 'ChickenFilletShopController');

Route::apiResource('type', 'TypeController');

Route::apiResource('user', 'UserController');

Route::post('pay', 'OpayPaymentController@pay');
Route::post('pay_CVS', 'OpayPaymentController@pay_cvs');
Route::post('receive', 'OpayPaymentController@receive');
