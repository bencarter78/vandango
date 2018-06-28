<?php

Route::group(['prefix' => 'v1/eportfolio', 'namespace' => 'Api\V1\Eportfolio'], function () {
    Route::get('centres', 'CentreController@index')->name('api.eportfolios.centres.index');
});