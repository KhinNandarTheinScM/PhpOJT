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
Route::get('users/create/','UserController@create')->name('user#create');
Route::post('users/confirm/','PostsController@confirm')->name('users#confirm');
Route::get('posts/index/','PostsController@index')->name('posts#index');
Route::get('posts/create/','PostsController@create')->name('posts#create');
Route::get('posts/{post}/edit/','PostsController@edit')->name('posts#edit');
Route::delete('posts/{post}/delete/','PostsController@delete')->name('posts#delete');
Route::get('/tasks','PostsController@exportCsv')->name('posts#tasks');

Route::post('posts/confirmupdate/','PostsController@confirmupdate')->name('posts#confirmupdate');
Route::post('posts/{post}/update/','PostsController@update')->name('posts#update');
Route::get('posts/destroy/','PostsController@destroy')->name('posts#destroy');
Route::post('posts/confirm/','PostsController@confirm')->name('posts#confirm');
Route::post('posts/store/','PostsController@store')->name('posts#store');
Route::get('/search','PostsController@search')->name('posts#search');
Route::get('/usersearch','UserController@search')->name('user#search');
Route::get('posts/showupload/','PostsController@showupload')->name('posts#showupload');
Route::post('posts/postupload','PostsController@postupload')->name('posts#postupload');
// Route::get('users/index/','UsersController@index')->name('users#index');