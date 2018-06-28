<?php

Route::group(['prefix' => 'classroom', 'middleware' => ['auth']], function () {
    Route::get('/', 'Classroom\UserDashboardController@index');
    Route::get('/manager', 'Classroom\ManagerDashboardController@index');
    Route::get('/manager/staff/{staffId}', 'Classroom\ManagerDashboardController@show');

    Route::resource('courses', 'Classroom\CourseController', [
        'names' => [
            'index' => 'classroom.courses.index',
            'create' => 'classroom.courses.create',
            'store' => 'classroom.courses.store',
            'show' => 'classroom.courses.show',
            'edit' => 'classroom.courses.edit',
            'update' => 'classroom.courses.update',
            'destroy' => 'classroom.courses.destroy',
        ],
    ]);

    Route::resource('timetable', 'Classroom\TimetableController', [
        'names' => [
            'index' => 'classroom.timetable.index',
            'create' => 'classroom.timetable.create',
            'store' => 'classroom.timetable.store',
            'show' => 'classroom.timetable.show',
            'edit' => 'classroom.timetable.edit',
            'update' => 'classroom.timetable.update',
            'destroy' => 'classroom.timetable.destroy',
        ],
    ]);

    Route::group(['prefix' => 'me'], function () {
        Route::get('/', 'Classroom\UserDashboardController@index');

        Route::resource('/learning-agreements', 'Classroom\LearningAgreementController', [
            'names' => [
                'index' => 'classroom.me.learning-agreements.index',
                'create' => 'classroom.me.learning-agreements.create',
                'store' => 'classroom.me.learning-agreements.store',
                'show' => 'classroom.me.learning-agreements.show',
                'edit' => 'classroom.me.learning-agreements.edit',
                'update' => 'classroom.me.learning-agreements.update',
                'destroy' => 'classroom.me.learning-agreements.destroy',
            ],
        ]);
    });
});
