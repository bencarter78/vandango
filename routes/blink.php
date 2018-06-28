<?php

Route::group(['prefix' => 'blink', 'namespace' => 'Blink', 'middleware' => ['auth']], function () {

    Route::get('/', 'EnquiryController@index')->name('blink.home');

    Route::get('me', 'UserEnquiriesController@index')->name('blink.enquiries.user');

    Route::resource('contacts', 'ContactController', [
        'names' => [
            'index' => 'blink.contacts.index',
            'create' => 'blink.contacts.create',
            'store' => 'blink.contacts.store',
            'show' => 'blink.contacts.show',
            'edit' => 'blink.contacts.edit',
            'update' => 'blink.contacts.update',
            'destroy' => 'blink.contacts.destroy',
        ],
    ]);

    Route::get('courses', 'CourseController@index')->name('blink.courses.index');
    Route::get('courses/create', 'CourseController@create')->name('blink.courses.create');
    Route::get('courses/{course}', 'CourseController@show')->name('blink.courses.show');
    Route::get('courses/{course}/edit', 'CourseController@edit')->name('blink.courses.edit');

    Route::get('departments', 'DepartmentController@index')->name('blink.departments.index');
    Route::get('departments/{id}', 'DepartmentController@show')->name('blink.departments.show');

    Route::resource('enquiries', 'EnquiryController', [
        'names' => [
            'index' => 'blink.enquiries.index',
            'create' => 'blink.enquiries.create',
            'store' => 'blink.enquiries.store',
            'show' => 'blink.enquiries.show',
            'edit' => 'blink.enquiries.edit',
            'update' => 'blink.enquiries.update',
            'destroy' => 'blink.enquiries.destroy',
        ],
    ]);

    Route::post('enquiries/{id}/activities', [
        'as' => 'blink.enquiries.activities.store',
        'uses' => 'EnquiryActivityController@store',
    ]);

    Route::post('enquiries/{id}/contacts', [
        'as' => 'blink.enquiries.contacts.store',
        'uses' => 'EnquiryContactController@store',
    ]);

    Route::put('enquiries/{id}/employee-count', [
        'as' => 'blink.enquiries.employee-count.update',
        'uses' => 'EnquiryEmployeeCountController@update',
    ]);

    Route::put('enquiries/{id}/campaigns', [
        'as' => 'blink.enquiries.campaigns.update',
        'uses' => 'EnquiryCampaignController@update',
    ]);

    Route::put('enquiries/{id}/locations', [
        'as' => 'blink.enquiries.locations.update',
        'uses' => 'EnquiryLocationController@update',
    ]);

    Route::post('enquiries/{id}/owners', [
        'as' => 'blink.enquiries.owners.store',
        'uses' => 'EnquiryOwnerController@store',
    ]);

    Route::post('enquiries/{id}/statuses', [
        'as' => 'blink.enquiries.statuses.store',
        'uses' => 'EnquiryStatusController@store',
    ]);

    Route::get('enquiries/{id}/vacancies/enable', [
        'as' => 'blink.enquiries.vacancies.enable',
        'uses' => 'EnquiryVacancyEnableController@index',
    ]);

    // Opportunities
    Route::get('opportunities', 'OpportunityController@index')->name('blink.opportunities.index');

    Route::get('organisations/enquiries', 'OrganisationEnquiryController@index')->name('blink.organisations.enquiries.index');

    Route::post('organisations/{id}/locations', 'OrganisationLocationController@store')->name('blink.organisations.locations.store');

    Route::post('organisations/{id}/locations', [
        'as' => 'blink.organisations.locations.store',
        'uses' => 'OrganisationLocationController@store',
    ]);

    Route::resource('organisations', 'OrganisationController', [
        'names' => [
            'index' => 'blink.organisations.index',
            'create' => 'blink.organisations.create',
            'store' => 'blink.organisations.store',
            'show' => 'blink.organisations.show',
            'edit' => 'blink.organisations.edit',
            'update' => 'blink.organisations.update',
            'destroy' => 'blink.organisations.destroy',
        ],
    ]);

    Route::group(['prefix' => 'reports'], function () {
        Route::get('campaigns', 'CampaignReportController@index')->name('blink.reports.campaigns');
        Route::get('vacancies', 'VacancyReportController@index')->name('blink.reports.vacancies');
    });

    Route::get('vacancies/duplicate/{id}', [
        'as' => 'blink.vacancies.duplicate',
        'uses' => 'VacancyDuplicateController@index',
    ]);

    Route::put('vacancies/{id}/approve', [
        'as' => 'blink.vacancies.approval',
        'uses' => 'VacancyApprovalController@update',
    ]);

    Route::put('vacancies/{id}/application-manager', [
        'as' => 'blink.vacancies.application-manager.update',
        'uses' => 'VacancyApplicationManagerController@update',
    ]);

    Route::put('vacancies/{id}/closing-date', [
        'as' => 'blink.vacancies.closing-date.update',
        'uses' => 'VacancyClosingDateController@update',
    ]);

    Route::put('vacancies/{id}/ref', [
        'as' => 'blink.vacancies.ref.update',
        'uses' => 'VacancyRefController@update',
    ]);

    Route::resource('vacancies', 'VacancyController', [
        'names' => [
            'index' => 'blink.vacancies.index',
            'create' => 'blink.vacancies.create',
            'store' => 'blink.vacancies.store',
            'show' => 'blink.vacancies.show',
            'edit' => 'blink.vacancies.edit',
            'update' => 'blink.vacancies.update',
            'destroy' => 'blink.vacancies.destroy',
        ],
    ]);
});