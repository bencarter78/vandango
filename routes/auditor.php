<?php

Route::group(['prefix' => 'auditor', 'middleware' => ['auth', 'auditor'], 'namespace' => 'Auditor'], function () {

    Route::get('/', 'TaskController@index')->name('auditor');

    // Tasks
    Route::post('tasks/clone', 'CloneTaskController@store')->name('auditor.tasks.clone.store');
    Route::get('tasks/trashed', 'TaskController@getTrashed')->name('auditor.tasks.trashed');
    Route::get('tasks/restore/{id}', 'TaskController@restore')->name('auditor.tasks.restore');

    Route::group(['as' => 'auditor.'], function () {
        Route::resource('tasks', 'TaskController');
        Route::resource('categories', 'CategoryController');
    });

    Route::get('audit/{id}', 'AuditController@index')->name('auditor.audit');
});