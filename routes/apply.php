<?php

Route::group(['prefix' => 'apply', 'middleware' => ['auth'], 'namespace' => 'Apply'], function () {
    Route::get('/', 'DashboardController@index')->name('apply.dashboard');

    Route::get('/applicants/unmatched', 'UnmatchedApplicantController@index')->name('apply.applicants.unmatched');

    Route::get('/me/applicants', 'UserApplicantController@index')->name('apply.me.applicants.index');
    Route::get('/applicants', 'ApplicantController@index')->name('apply.applicants.index');
    Route::get('/applicants/create', 'ApplicantController@create')->name('apply.applicants.create');
    Route::post('/applicants', 'ApplicantController@store')->name('apply.applicants.store');
    Route::get('/applicants/{id}', 'ApplicantController@edit')->name('apply.applicants.edit');

    Route::get('/reports', 'ReportController@index')->name('apply.reports.index');

    Route::get('/sectors', 'SectorController@index')->name('apply.sectors.index');
    Route::get('/sectors/{id}', 'SectorController@show')->name('apply.sectors.show');
});
