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

    /* Mail section */
    Route::get('/contract-ends/{project_id}', 'MailController@contractEnd')->name('notify.contract.end');

    /* Initial section */
    Route::group(['prefix' => 'initial'], function () {
        /* Categories based on B01, P01 */
        Route::get('/categories', 'CategoryController@index')->name('categories.index');

        /* Project section */
        Route::resource('/projects', 'ProjectController');
        Route::get('/projects-ajax-create', 'ProjectController@ajaxSubType')->name('projects.create.sub');
        Route::get('/projects/{id}/timeline', 'ProjectController@timeline')->name('projects.timeline');
        Route::get('/projects/{id}/view-download-file/{filename}', 'ProjectController@downloadFile')->name('projects.file.download');
        // Route::post('/projects/{id}/delete/{file_id}', 'ProjectController@destroyFile')->name('projects.destroy.file');


        /* Review section */
        Route::post('/reviews/{id}/approve-ks', 'ReviewController@approveKS')->name('reviews.approve.ks');
        Route::post('/reviews/{id}/kiv-ks', 'ReviewController@kivKS')->name('reviews.kiv.ks');
        Route::post('/reviews/{id}/reject-ks', 'ReviewController@rejectKS')->name('reviews.reject.ks');
        Route::post('/reviews/{id}/approve-sub', 'ReviewController@approveSUB')->name('reviews.approve.sub');
        Route::post('/reviews/{id}/kiv-sub', 'ReviewController@kivSUB')->name('reviews.kiv.sub');
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
        Route::get('/{project_id}/project-team/create-meeting/{id}', 'ProjectTeamController@createMeeting')->name('project-team.create.meeting');
        Route::post('/{project_id}/project-team/store-meeting/{id}', 'ProjectTeamController@storeMeeting')->name('project-team.store.meeting');

        /* Schedule section */
        Route::resource('/{project_id}/schedules', 'ScheduleController');
        // Route::put('/{project_id}/schedules/{id}/activity', 'ScheduleController@updateParent')->name('schedule.update.parent');

        /* Gantt section */
        Route::get('/{project_id}/gantt', 'GanttController@planning')->name('gantt.planning');

        /* Verification Section */
        Route::get('/{project_id}/verifications', 'VerificationController@index')->name('verifications.index');
        Route::post('/{project_id}/verifications/store', 'VerificationController@store')->name('verifications.store');

        /* Review */
        Route::get('/{project_id}/reviews', 'ReviewController@planningIndex')->name('planning.reviews.index');
        Route::post('/{project_id}/reviews/approve-ks', 'ReviewController@planningApproveKS')->name('planning.reviews.approve.ks');
        Route::post('/{project_id}/reviews/reject-ks', 'ReviewController@planningRejectKS')->name('planning.reviews.reject.ks');
        Route::post('/{project_id}/reviews/kiv-ks', 'ReviewController@planningKivKS')->name('planning.reviews.kiv.ks');
    });

    /* Collection section */
    Route::group(['prefix' => 'collection'], function () {
        /* Committee section */
        Route::get('/{project_id}/project-information', 'CommitteeController@project')->name('collection.project.information');
        Route::resource('/{project_id}/committees', 'CommitteeController');
        Route::get('/{project_id}/committees/edit/information/{id}', 'CommitteeController@editInformation')->name('committees.edit.information');
        Route::put('/{project_id}/committees/update/information/{id}', 'CommitteeController@updateInformation')->name('committees.update.information');
        Route::get('/{project_id}/committees/edit/direct-negotiation/information', 'CommitteeController@editInformationDirect')->name('committees.edit.information.direct');
        Route::put('/{project_id}/committees/update/direct-negotiation/information', 'CommitteeController@updateInformationDirect')->name('committees.update.information.direct');
        Route::get('/{project_id}/committees/view-download-file/{filename}', 'ProjectController@downloadFile')->name('committees.file.download');

        /* Methods section */
        Route::resource('/{project_id}/methods', 'CollectionMethodController');

        /* Gantt section */
        Route::get('/{project_id}/gantt', 'GanttController@collection')->name('gantt.collection');

        /* Results section */
        Route::resource('/{project_id}/results', 'ResultController');

        /* Contractors section */
        Route::resource('/{project_id}/contractors', 'ContractorController');
        Route::post('/{project_id}/contractors/contractor-appointment/store', 'ContractorController@storeAppointment')->name('contractors.appointment.store');
        Route::post('/{project_id}/contractors/contractor-details/store', 'ContractorController@storeDetails')->name('contractors.details.store');
        Route::post('/{project_id}/contractors/contractor-lists/store', 'ContractorController@storeLists')->name('contractors.lists.store');
        Route::post('/{project_id}/contractors/contractor-duration/store', 'ContractorController@storeDuration')->name('contractors.duration.store');
    });

    /* Development Section */
    Route::group(['prefix' => 'development'], function () {
        /* Contract section */
        Route::get('/{project_id}/project-information', 'ContractController@project')->name('development.project.information');
        Route::resource('/{project_id}/contracts', 'ContractController');

        /* Customer section */
        Route::resource('/{project_id}/customers', 'CustomerController');

        /* Scope section */
        Route::resource('/{project_id}/scopes', 'ScopeController');

        /* Org Chart section */
        Route::resource('/{project_id}/chart', 'OrganizationChartController');

        /* Meeting section */
        Route::resource('/{project_id}/meetings', 'MeetingController');
        Route::put('/{project_id}/meetings/{id}/update-meeting', 'MeetingController@updateMeeting')->name('meetings.update.actual');

        /* Record section */
        Route::resource('/{project_id}/records', 'RecordController');

        /* Interim section */
        Route::resource('/{project_id}/interims', 'InterimController');
        Route::get('/{project_id}/interims/{interim_id}/notify', 'InterimController@notify')->name('interims.notify');

        /* Bond section */
        Route::resource('/{project_id}/bond', 'BondController');

        /* EOT section */
        Route::resource('/{project_id}/eot', 'EotController');

        /* LAD section */
        Route::resource('/{project_id}/lad', 'LadController');
    });

    /* Termination Section */
    Route::group(['prefix' => 'termination'], function () {
        /* Project deliverables Section */
        Route::resource('/{project_id}/deliverables', 'DeliverController');

        /* Certificate Section */
        Route::get('/{project_id}/certificates', 'CertificateController@index')->name('certificates.index');
        Route::get('/{project_id}/certificates/edit-account', 'CertificateController@editAccount')->name('certificates.edit.account');
        Route::get('/{project_id}/certificates/edit-agreement', 'CertificateController@editAgreement')->name('certificates.edit.agreement');
        Route::post('/{project_id}/certificates/store', 'CertificateController@store')->name('certificates.store');
    });

    /* Financial section */
    Route::group(['prefix' => 'financial'], function () {
        /* Provision section */
        Route::resource('/provisions', 'ProvisionController');

        /* Allocation section */
        Route::resource('/{provision_id}/allocations', 'AllocationController');

        /* Transfer section */
        Route::group(['prefix' => 'B01'], function () {
            Route::resource('/transfers', 'AllocationTransferController');
            Route::get('/transfers-ajax-sub', 'AllocationTransferController@ajaxType')->name('transfers.create.type');
        });

        Route::group(['prefix' => 'BSPK'], function () {
            Route::resource('/transfers', 'BspkTransferController', [
                'as' => 'bspk'
            ]);

            Route::get('/transfers-ajax-sub', 'BspkTransferController@ajaxType')->name('bspk.transfers.create.type');
            Route::get('/transfers-ajax-project', 'BspkTransferController@ajaxProject')->name('bspk.transfers.create.project');
        });

        /* Progress Payment section */
        Route::resource('/payments', 'ProgressPaymentController');
        Route::get('/{project_id}/payments/list', 'ProgressPaymentController@list')->name('payments.list');
        Route::get('/{project_id}/payments/{id}/approve-payment', 'ProgressPaymentController@approve')->name('payments.approve');
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

    /* Unisel SSDU section */
    Route::resource('/officers', 'OfficerController');
});
