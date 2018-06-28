<?php

Route::group(['prefix' => 'roommate', 'middleware' => ['auth']], function () {

    Route::get('/', 'RoomMate\SiteController@index');

    Route::resource('sites', 'RoomMate\SiteController', [
        'names' => [
            'index' => 'roommate.sites.index',
            'create' => 'roommate.sites.create',
            'store' => 'roommate.sites.store',
            'show' => 'roommate.sites.show',
            'edit' => 'roommate.sites.edit',
            'update' => 'roommate.sites.update',
            'destroy' => 'roommate.sites.destroy',
        ],
    ]);

    Route::resource('rooms', 'RoomMate\RoomController', [
        'names' => [
            'index' => 'roommate.rooms.index',
            'create' => 'roommate.rooms.create',
            'store' => 'roommate.rooms.store',
            'show' => 'roommate.rooms.show',
            'edit' => 'roommate.rooms.edit',
            'update' => 'roommate.rooms.update',
            'destroy' => 'roommate.rooms.destroy',
        ],
    ]);

});
