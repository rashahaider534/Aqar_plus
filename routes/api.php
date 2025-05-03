<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('register',[AuthController::class,'register_user']);
Route::post('login',[AuthController::class,'login_user']);
//user

Route::middleware(['auth:sanctum','user.auth'])->group(function () {
Route::post('logout',[AuthController::class,'logout']);
Route::post('checkcode',[AuthController::class,'checkcode']);
});
//seller
Route::middleware(['auth:sanctum','seller.auth'])->group(function(){
Route::post('logout',[AuthController::class,'logout']);
Route::post('checkcode',[AuthController::class,'checkcode']);
});

