<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\TestController;
use  App\Http\Controllers\consumeApi\PlController;
use  App\Http\Controllers\Nursery\AvailableController;
use  App\Http\Controllers\UserController;


Route::get('/test', [TestController::class,'getApi']);
Route::get('/reset-password/{token}', [UserController::class,'reset_password_load']);
Route::post('/reset-password', [UserController::class,'reset_password']);


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
