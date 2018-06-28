<?php

Route::group(['middleware' => 'auth', 'namespace' => 'Cpd', 'prefix' => '/cpd'], function () {
    Route::get('/', 'ActivityController@index');

    Route::get('activities', 'ActivityController@index')->name('cpd.activities.index');
    Route::get('activities/create', 'ActivityController@create')->name('cpd.activities.create');
    Route::get('activities/{activity}/edit', 'ActivityController@edit')->name('cpd.activities.edit');

    Route::get('cv', 'CvController@edit')->name('cpd.cv.edit');
});
