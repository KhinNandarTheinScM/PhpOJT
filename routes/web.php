<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Project : Bulletin Board
| Description : "This page contains users routes, post routes and csv routes toward controllers"
|
*/

Route::get('/', function () {
    return view('user/login');
});

Route::get('users/','UserController@index')->name('user#index');
Route::post('users/checkuser','UserController@checkuser')->name('user#checkuser');
Route::get('posts/index/','PostsController@index')->name('posts#index');
// Route::post('users/checkuser', 'UserController@checkuser');
// {{url('someurl')}}
// Route::get('users/login','LoginController@index');
// Route::resource('/', LoginController::class);
// Route::resource('login', LoginController::class);