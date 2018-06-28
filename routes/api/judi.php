<?php

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'judi'], function () {
        Route::resource('sectors', 'Api\V1\Judi\SectorController');
    });
});
