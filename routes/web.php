<?php

use Illuminate\Support\Facades\Route;




Route::get('/login', 'App\Http\Controllers\LoginController@login')->name('login.index');
Route::post('/login', 'App\Http\Controllers\LoginController@_login')->name('login.login');

Route::get('/register', 'App\Http\Controllers\LoginController@register')->name('register.index');
Route::post('/register', 'App\Http\Controllers\LoginController@_register')->name('register.register');


Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['IsAdmin']], function () {

    });

    Route::group(['middleware' => ['IsSupervisor']], function () {

    });


    Route::get('/user', 'App\Http\Controllers\UserController@index')->name('user.index');
});
