<?php

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
    // If user is not authenticated
    if (empty(\Auth::user())) {
        return redirect('/login');
    }
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    /* User section */
    Route::resource('/users', 'UserController');
    Route::get('/users-search', 'UserController@search')->name('users.search');
    Route::get('/{id}/users-activate', 'UserController@activate')->name('users.activate');
    Route::get('/{id}/users-reset-password', 'UserController@reset')->name('users.reset');
    /* End */

    /* User section */
    Route::resource('/projects', 'ProjectController');
    /* End */
});
