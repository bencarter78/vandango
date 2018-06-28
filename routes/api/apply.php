<?php

Route::group(['prefix' => 'v1/apply', 'namespace' => 'Api\V1\Apply'], function () {
    Route::post('applicants/{id}/assign', 'ApplicantAssignmentController@store')->name('api.apply.applicants.assign');

    Route::post('applicants/{id}/paperwork-issue', 'ApplicantPaperworkIssueController@store')->name('api.apply.applicants.paperwork-issue');

    Route::patch('applicants/{id}/paperwork-received', 'PaperworkReceivedController@update')->name('api.apply.applicants.paperwork-received');

    Route::get('applicants/unmatched', 'UnmatchedApplicantController@index')->name('api.apply.applicants.unmatched');

    // Applicants Resource
    Route::get('applicants', 'ApplicantController@index')->name('api.apply.applicants.index');
    Route::post('applicants', 'ApplicantController@store')->name('api.apply.applicants.store');
    Route::put('applicants/{id}', 'ApplicantController@update')->name('api.apply.applicants.update');
    Route::delete('applicants/{id}', 'ApplicantController@destroy')->name('api.apply.applicants.destroy');

    Route::get('qualification-types', 'QualificationTypeController@index')->name('api.apply.qualification-types.index');

    Route::get('sectors', 'SectorController@index')->name('api.apply.sectors.index');

    Route::get('stats', 'StatsController@index')->name('api.apply.stats');

    Route::get('withdrawals', 'WithdrawalController@index')->name('api.apply.withdrawal');
});