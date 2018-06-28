<?php
Route::group(['prefix' => 'v1/cpd', 'namespace' => 'Api\V1\Cpd'], function () {
    Route::get('activities', 'ActivityController@index')->name('api.cpd.activities.index');
    Route::get('activities/{activity}', 'ActivityController@show')->name('api.cpd.activities.show');
    Route::post('activities', 'ActivityController@store')->name('api.cpd.activities.store');
    Route::patch('activities/{activity}', 'ActivityController@update')->name('api.cpd.activities.update');
    Route::delete('activities/{activity}', 'ActivityController@destroy')->name('api.cpd.activities.destroy');

    Route::post('certificates', 'CertificateController@store')->name('api.cpd.certificates.store');

    Route::patch('cv', 'CvController@update')->name('api.cpd.cv.update');

    Route::get('organisations/search', 'OrganisationSearchController@index')->name('api.cpd.organisations.search');
});