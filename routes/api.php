<?php

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
//user

Route::middleware(['user.auth'])->group(function(){
 
});

//seller

Route::middleware(['seller.auth'])->group(function(){


});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
