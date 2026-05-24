<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::view('/dashboard', 'layout.main')->name('dashboard');

Route::get('/',function(){
    return view('login.index');
});
Route::controller(LoginController::class)->group(function(){
    Route::post('/login/proses','proses');
    Route::get('/logout','logout');
});
