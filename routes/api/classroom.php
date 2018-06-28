<?php
Route::group(['prefix' => 'v1'], function () {

    Route::group(['prefix' => 'classroom'], function () {
        Route::resource('timetable', 'Api\V1\Classroom\TimetableController', [
            'names' => [
                'index' => 'api.classroom.timetable.index',
                'create' => 'api.classroom.timetable.create',
                'store' => 'api.classroom.timetable.store',
                'show' => 'api.classroom.timetable.show',
                'edit' => 'api.classroom.timetable.edit',
                'update' => 'api.classroom.timetable.update',
                'destroy' => 'api.classroom.timetable.destroy',
            ],
        ]);

        Route::resource('timetable.cohort', 'Api\V1\Classroom\CohortController', [
            'names' => [
                'index' => 'api.classroom.timetable.cohort.index',
                'create' => 'api.classroom.timetable.cohort.create',
                'store' => 'api.classroom.timetable.cohort.store',
                'show' => 'api.classroom.timetable.cohort.show',
                'edit' => 'api.classroom.timetable.cohort.edit',
                'update' => 'api.classroom.timetable.cohort.update',
                'destroy' => 'api.classroom.timetable.cohort.destroy',
            ],
        ]);

        Route::delete('timetable/{timetable}/cohort/{attendee}/{type}', 'Api\V1\Classroom\CohortController@destroy');
        Route::post('attendance', 'Api\V1\Classroom\AttendanceController@store');
    });
});