<?php

namespace App\Providers;

use App\Blink\Models\Course;
use App\Blink\Models\Enquiry;
use App\Blink\Models\Vacancy;
use App\Apply\Models\Applicant;
use App\Policies\Blink\CoursePolicy;
use App\Policies\Blink\VacancyPolicy;
use App\Policies\Blink\EnquiryPolicy;
use App\Policies\Apply\ApplicantPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // Apply
        Applicant::class => ApplicantPolicy::class,

        // Blink
        Course::class => CoursePolicy::class,
        Enquiry::class => EnquiryPolicy::class,
        Vacancy::class => VacancyPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
