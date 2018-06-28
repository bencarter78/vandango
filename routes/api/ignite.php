<?php

Route::group(['prefix' => 'v1/ignite', 'namespace' => 'Api\V1\Ignite'], function () {
    Route::get('campaigns', 'CampaignController@index')->name('api.ignite.campaigns.index');

    Route::get('enquiries', 'EnquiryController@index')->name('api.ignite.enquiries.index');
});
