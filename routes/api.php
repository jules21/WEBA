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

Route::group(['prefix' => 'v1/mobile'], function () {
    Route::post('/login', [App\Http\Controllers\Api\Mobile\LoginController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        //mobile protected routes goes here

        Route::get('/billing/recent', [App\Http\Controllers\Api\Mobile\BillingController::class, 'recentRecords']);

    });

});
