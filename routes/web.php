<?php

use App\Mail\CodeMail;
use App\Mail\Welcome;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//user

Route::middleware(['auth:sanctum','user.auth'])->group(function(){

});

Route::middleware(['auth:sanctum','seller.auth'])->group(function(){


});
//rasha
