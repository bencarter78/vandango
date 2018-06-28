<?php

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'roommate'], function () {
        Route::resource('rooms', 'Api\V1\RoomMate\Rooms\RoomController', [
            'names' => [
                'index' => 'api.roommate.rooms.index',
                'create' => 'api.roommate.rooms.create',
                'store' => 'api.roommate.rooms.store',
                'show' => 'api.roommate.rooms.show',
                'edit' => 'api.roommate.rooms.edit',
                'update' => 'api.roommate.rooms.update',
                'destroy' => 'api.roommate.rooms.destroy',
            ],
        ]);
    });
});
