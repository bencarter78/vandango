<?php

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'papi'], function () {
        Route::resource('organisations', 'Api\V1\Papi\OrganisationController');
    });
});
