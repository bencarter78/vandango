<?php

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'datastore'], function () {
        Route::get('qualifications-plans', 'Api\V1\Datastore\QualificationPlanController@index')->name('api.datastore.qualification-plans.index');
    });
});