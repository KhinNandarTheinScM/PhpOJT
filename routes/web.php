<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\VisitorsMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Project : Bulletin Board
| Description : "This page contains users routes, post routes and csv routes toward controllers"
|
*/

// Route::get('/', function () {
//     return view('user/login');
// });
Route::get('/', 'UserController@login')->name('user#login');
Route::get('login/', 'UserController@login')->name('user#login');

Route::group(['middleware' => ['visitors']], function () {
    Route::get('users/', 'UserController@index')->name('user#index');
    Route::get('/', 'PostsController@index')->name('posts#index');
    Route::get('user/showprofile', 'UserController@showprofile')->name('user#showprofile');
    Route::delete('user/{user}/delete/', 'UserController@delete')->name('user#delete');
    Route::get('user/showprofile/{user}/edit/', 'UserController@edit')->name('user#editprofile');
    Route::get('user/showprofile/{user}/edit/changepassword', 'UserController@changepassword')->name('user#changepassword');
    Route::post('user/showprofile/{user}/edit/changepassword/change', 'UserController@changepasswordupdate')->name('changepassword#change');
    Route::post('users/profile/', 'UserController@profileconfirm')->name('users#profileconfirm');
    Route::post('users/profile/confirm/', 'UserController@confirmprofileupdate')->name('users#confirmprofileupdate');
    Route::post('users/checkuser', 'UserController@checkuser')->name('user#checkuser');
    Route::get('users/create/', 'UserController@create')->name('user#create');
    Route::post('users/store', 'UserController@store')->name('users#store');
    Route::post('users/confirm/', 'UserController@confirm')->name('users#confirm');
    Route::get('posts/index/', 'PostsController@index')->name('posts#index');
    Route::get('posts/create/', 'PostsController@create')->name('posts#create');
    Route::get('posts/logout', 'UserController@logout')->name('posts#logout');
    Route::get('posts/{post}/edit/', 'PostsController@edit')->name('posts#edit');
    Route::delete('posts/{post}/delete/','PostsController@delete')->name('posts#delete');
    // Route::post('posts/{post}/delete/', 'PostsController@delete')->name('posts#delete');
    Route::get('/tasks', 'PostsController@exportCsv')->name('posts#tasks');
    Route::get('/exportExcel', 'PostsController@exportExcel')->name('posts#export');
    // Route::get('exportExcel/{type}', [ExcelController::class, 'exportExcel'])->name('exportExcel');

    Route::post('posts/confirmupdate/', 'PostsController@confirmupdate')->name('posts#confirmupdate');
    Route::post('posts/{post}/update/', 'PostsController@update')->name('posts#update');
    Route::get('posts/destroy/', 'PostsController@destroy')->name('posts#destroy');
    Route::post('posts/confirm/', 'PostsController@confirm')->name('posts#confirm');
    Route::post('posts/store/', 'PostsController@store')->name('posts#store');
    Route::get('/search', 'PostsController@search')->name('posts#search');
    Route::get('/usersearch', 'UserController@search')->name('user#search');
    Route::get('posts/showupload/', 'PostsController@showupload')->name('posts#showupload');
    Route::post('posts/postupload', 'PostsController@postupload')->name('posts#postupload');
    // Route::get('users/index/','UsersController@index')->name('users#index');

});
