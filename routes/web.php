<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class,'index'])->name('dashboard');
    Route::get("/users/profile/{user_id}", [App\Http\Controllers\UserController::class, 'userProfile'])->name("users.profile");
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

