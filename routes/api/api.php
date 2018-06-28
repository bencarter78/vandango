<?php

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function () {
    Route::get('uploads', 'FileUploadController@index')->name('api.uploads.index');
    Route::post('uploads', 'FileUploadController@store')->name('api.uploads.store');
});