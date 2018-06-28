<?php

Route::group(['prefix' => 'v1/auditor', 'namespace' => 'Api\V1\Auditor'], function () {
    Route::delete('tasks/{task}', 'TaskController@destroy')->name('api.auditor.tasks.destroy');
});