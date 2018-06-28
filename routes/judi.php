<?php

Route::group(['prefix' => 'judi', 'middleware' => ['auth', 'judi']], function () {
    Route::get('/', [
        'as' => 'judi.dashboard',
        'uses' => 'Judi\DashboardController@index',
    ]);

    // Sectors
    Route::get('sectors/{id}/planned', [
        'as' => 'judi.sectors.planned',
        'uses' => 'Judi\SectorController@planned',
    ]);
    Route::get('sectors/{id}/submitted', [
        'as' => 'judi.sectors.submitted',
        'uses' => 'Judi\SectorController@submitted',
    ]);
    Route::get('sectors/{id}/staff', [
        'as' => 'judi.sectors.staff',
        'uses' => 'Judi\SectorController@staff',
    ]);

    // Assessors
    Route::get('assessors/{id}/planned', [
        'as' => 'judi.assessors.planned',
        'uses' => 'Judi\AssessorController@planned',
    ]);
    Route::get('assessors/{id}/submitted', [
        'as' => 'judi.assessors.submitted',
        'uses' => 'Judi\AssessorController@submitted',
    ]);

    // Assessments
    Route::get('assessments/sector/{id}', [
        'as' => 'judi.assessments.sector',
        'uses' => 'Judi\AssessmentController@sector',
    ]);

    Route::get('assessments/user/{id}/planned', [
        'as' => 'judi.assessments.user.planned',
        'uses' => 'Judi\AssessmentController@userPlanned',
    ]);

    Route::get('assessments/user/{id}/submitted', [
        'as' => 'judi.assessments.user.submitted',
        'uses' => 'Judi\AssessmentController@userSubmitted',
    ]);

    Route::get('assessments/user/{id}/settings', [
        'as' => 'judi.assessments.user.settings.edit',
        'uses' => 'Judi\UserAssessmentSettingsController@edit',
    ]);

    Route::post('assessments/user/{id}/settings', [
        'as' => 'judi.assessments.user.settings.update',
        'uses' => 'Judi\UserAssessmentSettingsController@update',
    ]);

    Route::get('assessments/report/{id}', [
        'as' => 'judi.assessments.report',
        'uses' => 'Judi\AssessmentController@getReport',
    ]);

    Route::post('assessments/report/{id}', [
        'as' => 'judi.assessments.report.save',
        'uses' => 'Judi\AssessmentController@postReport',
    ]);

    // Processes
    Route::get('processes/trashed', [
        'as' => 'judi.processes.trashed',
        'uses' => 'Judi\ProcessController@getTrashed',
    ]);

    Route::get('processes/restore/{id}', [
        'as' => 'judi.processes.restore',
        'uses' => 'Judi\ProcessController@restore',
    ]);

    // Grades
    Route::get('grades/trashed', [
        'as' => 'judi.grades.trashed',
        'uses' => 'Judi\GradeController@getTrashed',
    ]);

    Route::get('grades/restore/{id}', [
        'as' => 'judi.grades.restore',
        'uses' => 'Judi\GradeController@restore',
    ]);

    // Cancellations
    Route::get('cancellations/trashed', [
        'as' => 'judi.cancellations.trashed',
        'uses' => 'Judi\CancellationController@getTrashed',
    ]);

    Route::get('cancellations/restore/{id}', [
        'as' => 'judi.cancellations.restore',
        'uses' => 'Judi\CancellationController@restore',
    ]);

    // Criteria
    Route::get('criteria/trashed', [
        'as' => 'judi.criteria.trashed',
        'uses' => 'Judi\CriteriaController@getTrashed',
    ]);
    Route::get('criteria/restore/{id}', [
        'as' => 'judi.criteria.restore',
        'uses' => 'Judi\CriteriaController@restore',
    ]);

    // Documents
    Route::get('documents/trashed', [
        'as' => 'judi.documents.trashed',
        'uses' => 'Judi\DocumentController@getTrashed',
    ]);
    Route::get('documents/restore/{id}', [
        'as' => 'judi.documents.restore',
        'uses' => 'Judi\DocumentController@restore',
    ]);

    // Process Reports
    Route::get('reports/trashed', [
        'as' => 'judi.reports.trashed',
        'uses' => 'Judi\ReportController@getTrashed',
    ]);

    Route::get('reports/restore/{id}', [
        'as' => 'judi.reports.restore',
        'uses' => 'Judi\ReportController@restore',
    ]);

    // Summaries
    Route::get('summaries/select/{assessmentId}', [
        'as' => 'judi.summaries.select',
        'uses' => 'Judi\SummarySelectionController@index',
    ]);

    Route::post('summaries/select/{assessmentId}', [
        'as' => 'judi.summaries.select.post',
        'uses' => 'Judi\SummarySelectionController@store',
    ]);

    Route::get('summaries/create/{assessmentId}/{reportId}', [
        'as' => 'judi.summaries.create',
        'uses' => 'Judi\SummaryController@create',
    ]);

    Route::get('summaries/documentation/{summaryId}', [
        'as' => 'judi.summaries.documentation',
        'uses' => 'Judi\SummaryDocumentation@index',
    ]);

    Route::put('summaries/outcome/{summaryId}', [
        'as' => 'judi.summaries.outcome',
        'uses' => 'Judi\SummaryOutcomeController@update',
    ]);

    Route::group(['as' => 'judi.'], function () {
        Route::resource('sectors', 'Judi\SectorController');
        Route::resource('assessors', 'Judi\AssessorController');
        Route::resource('assessments', 'Judi\AssessmentController');
        Route::resource('processes', 'Judi\ProcessController');
        Route::resource('grades', 'Judi\GradeController');
        Route::resource('cancellations', 'Judi\CancellationController');
        Route::resource('criteria', 'Judi\CriteriaController');
        Route::resource('documents', 'Judi\DocumentController');
        Route::resource('reports', 'Judi\ReportController');
        Route::resource('summaries', 'Judi\SummaryController');
    });

    Route::get('analysis/summaries', 'Judi\SummaryAnalysisController@index')->name('judi.analysis.summaries');
    Route::get('analysis/criteria', 'Judi\CriteriaAnalysisController@index')->name('judi.analysis.criteria');
});
