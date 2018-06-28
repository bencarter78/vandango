<?php

Route::group(['middleware' => ['auth', 'surveyHoundAdmin']], function () {

    Route::get('surveyhound/trashed', [
        'as' => 'surveyhound.trashed',
        'uses' => 'SurveyHound\SurveysController@trashed',
    ]);

    Route::get('surveyhound/{id}/restore', [
        'as' => 'surveyhound.restore',
        'uses' => 'SurveyHound\SurveysController@restore',
    ]);

    Route::resource('surveyhound', 'SurveyHound\SurveysController');

    Route::get('surveyhound/send/{id}', [
        'as' => 'surveyhound.send',
        'uses' => 'SurveyHound\SendController@index',
    ]);

});
