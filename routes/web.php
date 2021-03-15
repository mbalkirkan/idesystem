<?php


use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['IsUnLoggedIn']], function () {

    Route::get('/login', 'App\Http\Controllers\LoginController@login')->name('login.index');
    Route::post('/login', 'App\Http\Controllers\LoginController@_login')->name('login.login');

    Route::get('/register', 'App\Http\Controllers\LoginController@register')->name('register.index');
    Route::post('/register', 'App\Http\Controllers\LoginController@_register')->name('register.register');


});



Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', 'App\Http\Controllers\AuthController@profile')->name('auth.profile.index');
    Route::post('/profile_update', 'App\Http\Controllers\AuthController@profile_update')->name('auth.profile.update');
    Route::post('/profile_update_password', 'App\Http\Controllers\AuthController@update_password')->name('auth.profile.update.password');
    Route::group(['middleware' => ['IsAdmin']], function () {
        Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin.index');
        Route::get('/admin/product', 'App\Http\Controllers\AdminProductController@index')->name('admin.product.index');
        Route::post('/admin/product/add', 'App\Http\Controllers\AdminProductController@add')->name('admin.product.add');
        Route::get('/admin/product/toggle', 'App\Http\Controllers\AdminProductController@toggle')->name('admin.product.toggle');
        Route::post('/admin/product/define', 'App\Http\Controllers\AdminProductController@define')->name('admin.product.define');
        Route::get('/admin/product/delete', 'App\Http\Controllers\AdminProductController@delete')->name('admin.product.delete');
        Route::post('/admin/product/update', 'App\Http\Controllers\AdminProductController@update')->name('admin.product.update');


        Route::get('/admin/user', 'App\Http\Controllers\AdminUserController@index')->name('admin.user.index');
        Route::post('/admin/user/update', 'App\Http\Controllers\AdminUserController@update')->name('admin.user.update');
        Route::get('/admin/user/delete', 'App\Http\Controllers\AdminUserController@delete')->name('admin.user.delete');
        Route::post('/admin/user/licence/get', 'App\Http\Controllers\AdminUserController@get_licence')->name('admin.user.get.licence');
    });

    Route::group(['middleware' => ['IsSupervisor']], function () {
        Route::get('/supervisor', 'App\Http\Controllers\SupervisorController@index')->name('supervisor.index');
    });


    Route::group(['middleware' => ['IsUser']], function () {
        Route::get('/user', 'App\Http\Controllers\UserController@index')->name('user.index');
    });


    Route::get('/main', 'App\Http\Controllers\AuthController@main')->name('auth.index');
    Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('auth.logout');
});


Route::get('/idesystem', function (){
    $arr=['mbalkirkan'];
    $text="";
    foreach ($arr as $item) {
        $text.=$item."*";
    }
    return $text;
});
