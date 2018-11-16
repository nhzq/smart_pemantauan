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
Route::get('locale/{locale}', function ($locale) {
    \Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/', function () {
    // If user is not authenticated
    if (empty(\Auth::user())) {
        return redirect('/login');
    }
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    /* Project section */
    Route::resource('/projects', 'ProjectController');
    /* End */

    /* Review section */
    Route::resource('/reviews', 'ReviewController');
    Route::post('/reviews/{id}/approve-ks', 'ReviewController@approveKS')->name('reviews.approve.ks');
    Route::post('/reviews/{id}/reject-ks', 'ReviewController@rejectKS')->name('reviews.reject.ks');
    Route::post('/reviews/{id}/approve-kj', 'ReviewController@approveKJ')->name('reviews.approve.kj');
    Route::post('/reviews/{id}/reject-kj', 'ReviewController@rejectKJ')->name('reviews.reject.kj');
    /* End */

    /* Financial section */
    Route::group(['prefix' => 'financial'], function () {
        Route::group(['prefix' => 'allocations'], function () {
            Route::get('/', 'AllocationController@index')->name('allocations.index');
            Route::get('/{id}/type', 'AllocationController@type')->name('allocations.type');
            Route::get('/{id}/create', 'AllocationController@create')->name('allocations.create');
            Route::post('/{id}/store', 'AllocationController@store')->name('allocations.store');
        });
    });
    /* End */

    /* Setting section */
    Route::group(['prefix' => 'settings'], function () {
        Route::resource('/users', 'UserController');
        Route::get('/users-search', 'UserController@search')->name('users.search');
        Route::get('/users-ajax-section', 'UserController@ajaxSection')->name('users.create.section');
        Route::get('/users-ajax-unit', 'UserController@ajaxUnit')->name('users.create.unit');
        Route::get('/{id}/users-activate', 'UserController@activate')->name('users.activate');
        Route::get('/{id}/users-reset-password', 'UserController@reset')->name('users.reset');
        /* End */

        /* Role section */
        Route::resource('/roles', 'RoleController');
        /* End */

        /* Unit section */
        Route::resource('/units', 'LookupUnitController');
        /* End */

        /* Section section */
        Route::resource('/sections', 'LookupSectionController');
        /* End */
    });
});
