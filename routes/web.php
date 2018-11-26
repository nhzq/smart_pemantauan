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

    return redirect()->route('home');

});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    /* Initial section */
    Route::group(['prefix' => 'initial'], function () {
        /* Project section */
        Route::resource('/projects', 'ProjectController');
        Route::get('/projects-ajax-create', 'ProjectController@ajaxSubType')->name('projects.create.sub');
        Route::get('/projects/{id}/timeline', 'ProjectController@timeline')->name('projects.timeline');
        Route::get('/projects/{id}/planning-phase', 'ProjectController@planningPhase')->name('projects.phase');
        Route::get('/projects/{id}/view-download-file/{filename}', 'ProjectController@downloadFile')->name('projects.file.download');


        /* Review section */
        Route::post('/reviews/{id}/approve-ks', 'ReviewController@approveKS')->name('reviews.approve.ks');
        Route::post('/reviews/{id}/reject-ks', 'ReviewController@rejectKS')->name('reviews.reject.ks');
        Route::post('/reviews/{id}/approve-sub', 'ReviewController@approveSUB')->name('reviews.approve.sub');
        Route::post('/reviews/{id}/reject-sub', 'ReviewController@rejectSUB')->name('reviews.reject.sub');
    });

    /* Planning section */
    Route::group(['prefix' => 'planning'], function () {
        /* Project Information section */
        Route::get('/{project_id}/project-information', 'ProjectInformationController@index')->name('info.index');
        Route::get('/{project_id}/project-information/edit', 'ProjectInformationController@edit')->name('info.edit');
        Route::put('/{project_id}/project-information/update', 'ProjectInformationController@update')->name('info.update');

        /* Analysis section */
        Route::resource('/{project_id}/analyses', 'AnalysisController');

        /* Project Team section */
        Route::resource('/{project_id}/project-team', 'ProjectTeamController');
        Route::get('/project-team-ajax-create', 'ProjectTeamController@ajaxType')->name('project-team.create.type');

        /* Verification Section */
        Route::get('/{project_id}/verifications', 'VerificationController@index')->name('verifications.index');
        Route::post('/{project_id}/verifications/store', 'VerificationController@store')->name('verifications.store');
    });

    /* Financial section */
    Route::group(['prefix' => 'financial'], function () {
        /* Allocation section */
        Route::resource('/allocations', 'AllocationController');
        Route::get('/allocations-ajax-create', 'AllocationController@ajaxType')->name('allocations.create.type');

        /* Allocation Transfer section */
        Route::resource('/transfers', 'AllocationTransferController');
        Route::get('/transfers-ajax-sub', 'AllocationTransferController@ajaxType')->name('transfers.create.type');
    });

    /* Setting section */
    Route::group(['prefix' => 'settings'], function () {
        Route::resource('/users', 'UserController');
        Route::get('/users-search', 'UserController@search')->name('users.search');
        Route::get('/users-ajax-section', 'UserController@ajaxSection')->name('users.create.section');
        Route::get('/users-ajax-unit', 'UserController@ajaxUnit')->name('users.create.unit');
        Route::get('/{id}/users-activate', 'UserController@activate')->name('users.activate');
        Route::get('/{id}/users-reset-password', 'UserController@reset')->name('users.reset');

        /* Role section */
        Route::resource('/roles', 'RoleController');

        /* Unit section */
        Route::resource('/units', 'LookupUnitController');

        /* Section section */
        Route::resource('/sections', 'LookupSectionController');
    });
});
