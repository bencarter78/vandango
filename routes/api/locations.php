<?php

Route::group(['prefix' => 'v1/locations'], function () {
    Route::resource('search/venues', 'Api\V1\Locations\VenueSearchController');
});
