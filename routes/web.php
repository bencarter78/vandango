<?php

Route::group(['prefix' => 'auth'], function () {
    Auth::routes();
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        return redirect('/forum');
    });

    Route::group(['prefix' => 'keysafe'], function () {
        Route::get('/', function () {
            return redirect('keysafe/keys');
        });

        Route::group(['as' => 'keysafe.'], function () {
            Route::resource('keys', 'KeySafe\KeyController');
        });
    });

    Route::resource('locations', 'Locations\LocationController');
});

Auth::routes();

Route::get('/home', 'HomeController@index');