<?php

Route::group(['prefix' => 'usermanager', 'namespace' => 'UserManager', 'middleware' => 'auth', 'jwt.refresh'], function () {

    // Displaying user info
    Route::get('/', [
        'as' => 'users.index',
        'uses' => 'UserController@index',
    ]);

    // Registering & Activating
    Route::get('users/register', [
        'as' => 'users.register',
        'middleware' => 'auth.isHr',
        'uses' => 'RegistrationController@create',
    ]);
    Route::post('users/register', [
        'as' => 'register.store',
        'middleware' => 'auth.isHr',
        'uses' => 'RegistrationController@store',
    ]);

    // Deleting, Trashed and Restoring
    Route::delete('users/delete/{id}', [
        'as' => 'users.delete',
        'middleware' => 'auth.isHr',
        'uses' => 'UserController@destroy',
    ]);
    Route::get('users/trash', [
        'as' => 'users.trashed',
        'middleware' => 'auth.isHr',
        'uses' => 'UserTrashController@index',
    ]);
    Route::get('users/restore/{id}', [
        'as' => 'users.restore',
        'middleware' => 'auth.isHr',
        'uses' => 'UserRestoreController@index',
    ]);

    // Home
    Route::get('dashboard', [
        'as' => 'users.dashboard',
        'uses' => 'DashboardController@index',
    ]);

    /*
     * User Accounts
     */
    Route::group(['prefix' => 'account'], function () {
        Route::get('{username}', [
            'as' => 'account.show',
            'uses' => 'AccountController@show',
        ]);
        Route::get('{username}/edit', [
            'as' => 'account.edit',
            'middleware' => 'auth.canEditUser',
            'uses' => 'AccountController@edit',
        ]);

        /*
         * Updating Account
         */
        Route::post('{username}/update', [
            'as' => 'account.update',
            'middleware' => 'auth.canEditUser',
            'uses' => 'AccountController@update',
        ]);

        Route::post('groups/{id}', [
            'as' => 'users.groups',
            'middleware' => 'auth.isAdmin',
            'uses' => 'UserController@postGroups',
        ]);
        Route::post('delete/{id}', [
            'middleware' => 'auth.isHr',
            'uses' => 'UserController@postDelete',
        ]);

    });

    Route::resource('roles', 'RoleController', [
        'names' => [
            'index' => 'roles.index',
            'create' => 'roles.create',
            'store' => 'roles.store',
            'show' => 'roles.show',
            'edit' => 'roles.edit',
            'update' => 'roles.update',
            'destroy' => 'roles.destroy',
        ],
    ]);

    /*
     * Groups
     */
    Route::resource('groups', 'GroupController', [
        'names' => [
            'index' => 'groups.index',
            'show' => 'groups.show',
        ],
    ]);

    /*
     * Sectors
     */
    Route::get('sectors/search', [
        'as' => 'sectors.search',
        'uses' => 'SectorSearchController@index',
    ]);

    Route::resource('sectors', 'SectorController', [
        'names' => [
            'index' => 'sectors.index',
            'create' => 'sectors.create',
            'store' => 'sectors.store',
            'show' => 'sectors.show',
            'edit' => 'sectors.edit',
            'update' => 'sectors.update',
            'destroy' => 'sectors.destroy',
        ],
    ]);

    /*
     * Departments
     */
    Route::get('departments/search', [
        'as' => 'departments.search',
        'uses' => 'DepartmentSearchController@index',
    ]);

    Route::resource('departments', 'DepartmentController', [
        'names' => [
            'index' => 'departments.index',
            'create' => 'departments.create',
            'store' => 'departments.store',
            'show' => 'departments.show',
            'edit' => 'departments.edit',
            'update' => 'departments.update',
            'destroy' => 'departments.destroy',
        ],
    ]);

    // Resource Trash
    Route::get('trash/{resource}', [
        'as' => 'usermanager.trash',
        'middleware' => 'auth.isHr',
        'uses' => 'TrashController@index',
    ]);

    // Resource Restore
    Route::get('restore/{resource}/{id}', [
        'as' => 'usermanager.restore',
        'middleware' => 'auth.isHr',
        'uses' => 'RestoreController@index',
    ]);

    Route::get('probation', [
        'as' => 'users.probation',
        'uses' => 'ProbationController@index',
    ]);

    Route::get('me/notifications', 'NotificationController@index')->name('usermanager.users.notifications.index');
});