<?php
Route::group(['prefix' => 'v1/blink', 'namespace' => 'Api\V1\Blink'], function () {
    // Applicants
    Route::post('applicants', 'ApplicantController@store')->name('api.blink.applicants.store');

    // Applications
    Route::get('vacancies/{ref}/applications', 'VacancyApplicationController@index')->name('api.blink.vacancies.applications');

    // Awarding Bodies
    Route::get('awarding-bodies', 'AwardingBodyController@index')->name('api.blink.awarding-bodies.index');

    // Contacts
    Route::resource('contacts', 'ContactController', [
        'names' => [
            'index' => 'api.blink.contacts.index',
            'create' => 'api.blink.contacts.create',
            'store' => 'api.blink.contacts.store',
            'show' => 'api.blink.contacts.show',
            'edit' => 'api.blink.contacts.edit',
            'update' => 'api.blink.contacts.update',
            'destroy' => 'api.blink.contacts.destroy',
        ],
    ]);

    // Courses
    Route::get('courses', 'CourseController@index')->name('api.blink.courses.index');
    Route::post('courses', 'CourseController@store')->name('api.blink.courses.store');
    Route::put('courses/{course}', 'CourseController@update')->name('api.blink.courses.update');

    // Departments
    Route::get('departments', 'DepartmentController@index')->name('api.blink.departments.index');
    Route::get('departments/{id}', 'DepartmentController@show')->name('api.blink.departments.show');

    // Enquiries
    Route::put('enquiries/{id}/contacts', 'EnquiryContactController@update')->name('api.blink.enquiries.contacts.update');
    Route::post('enquiries/{id}/opportunities', 'EnquiryOpportunityController@store')->name('api.blink.opportunities.store');
    Route::delete('enquiries/{enquiry}/opportunities/{opportunity}', 'EnquiryOpportunityController@destroy')->name('api.blink.opportunities.destroy');
    Route::get('enquries/search', 'EnquirySearchController@index')->name('api.blink.enquiries.search');

    Route::resource('enquiries', 'EnquiryController', [
        'names' => [
            'index' => 'api.blink.enquiries.index',
            'create' => 'api.blink.enquiries.create',
            'store' => 'api.blink.enquiries.store',
            'show' => 'api.blink.enquiries.show',
            'edit' => 'api.blink.enquiries.edit',
            'update' => 'api.blink.enquiries.update',
            'destroy' => 'api.blink.enquiries.destroy',
        ],
    ]);

    // Opportunities
    Route::get('opportunities', 'OpportunityController@index');

    // Organisations
    Route::get('organisations/enquiries', 'OrganisationEnquiryController@index')->name('api.blink.organisations.enquiries.index');

    // Organisation matching to PICS
    Route::get('organisations/{organisation}/match', 'OrganisationMatchController@show')->name('api.blink.organisations.match.show');
    Route::put('organisations/{organisation}/match', 'OrganisationMatchController@update')->name('api.blink.organisations.match.update');

    Route::resource('organisations', 'OrganisationController', [
        'names' => [
            'index' => 'api.blink.organisations.index',
            'create' => 'api.blink.organisations.create',
            'store' => 'api.blink.organisations.store',
            'show' => 'api.blink.organisations.show',
            'edit' => 'api.blink.organisations.edit',
            'update' => 'api.blink.organisations.update',
            'destroy' => 'api.blink.organisations.destroy',
        ],
    ]);

    Route::get('organisations/{organisation}/contacts', 'OrganisationContactController@index');

    // Users
    Route::get('users/{user}/enquiries', 'UserEnquiriesController@show')->name('api.blink.user.enquiries');

    // Vacancies
    Route::get('vacancies', 'VacancyController@index')->name('api.blink.vacancies.index');
    Route::delete('vacancies/{vacancy}', 'VacancyController@destroy')->name('api.blink.vacancies.destroy');
    Route::post('vacancies/{vacancy}/hires', 'VacancyHireController@store')->name('api.blink.vacancies.hires.store');
});