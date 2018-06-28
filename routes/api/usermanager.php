<?php

Route::group(['prefix' => 'v1/usermanager', 'namespace' => 'Api\V1\UserManager'], function () {
    Route::resource('departments', 'DepartmentController');

    Route::resource('guests', 'GuestController');

    Route::resource('sectors', 'SectorController', [
        'names' => [
            'index' => 'api.usermanager.sectors.index',
            'create' => 'api.usermanager.sectors.create',
            'store' => 'api.usermanager.sectors.store',
            'show' => 'api.usermanager.sectors.show',
            'edit' => 'api.usermanager.sectors.edit',
            'update' => 'api.usermanager.sectors.update',
            'destroy' => 'api.usermanager.sectors.destroy',
        ],
    ]);

    Route::get('users/search', 'UserController@search');

    Route::get('users/probation', 'ProbationController@index');

    Route::get('users/{user}/notifications', 'NotificationController@index')->name('api.usermanager.users.notifications.index');
    Route::patch('notifications/{notification}', 'NotificationController@update')->name('api.usermanager.notifications.update');

    Route::resource('users', 'UserController');
});
