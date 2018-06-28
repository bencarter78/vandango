<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        // General
        'App\Events\MessageWasBroadcast' => [
            //
        ],

        // Apply
        'App\Events\Apply\StartWasIdentified' => [
            'App\Listeners\Apply\CreatePicsApplication',
            //            'App\Listeners\Apply\FlushPipelineCache',
            'App\Listeners\Apply\SendApplicantRequiresAdviserNotification',
            'App\Listeners\Blink\NotifyApplicationManagerApplicantWasIdentified',
        ],

        'App\Events\Apply\ApplicantWasAssigned' => [
            'App\Listeners\Apply\ApplicantAssignedToAdviserNotification',
        ],

        'App\Events\Apply\ApplicantWasMatched' => [
            'App\Listeners\Apply\ApplicantMatchedNotification',
        ],

        // Blink
        'App\Events\Blink\AccountManagerWasUpdated' => [
            'App\Listeners\Blink\SendEnquiryAssignedToAccountManagerNotification',
            'App\Listeners\Blink\SetStatusToUnqualified',
        ],
        'App\Events\Blink\ApplicationManagerWasAssigned' => [
            'App\Listeners\Blink\SendApplicationManagerAssignedToVacancyNotification',
        ],
        'App\Events\Blink\EnquiryWasAdded' => [
            //
        ],
        'App\Events\Blink\CoursePriceListWasUpdated' => [
            'App\Listeners\Blink\UpdateExternalPricingCatalogue',
        ],
        'App\Events\Blink\EnquiryWasCompleted' => [
            'App\Listeners\Blink\DeleteOpportunities',
            'App\Listeners\Blink\DeleteVacancies',
        ],
        'App\Events\Blink\OrganisationWasAdded' => [
            //
        ],
        'App\Events\Blink\VacancyClosingDateWasChanged' => [
            'App\Listeners\Blink\SendVacancyClosingDateUpdatedNotification',
        ],
        'App\Events\Blink\VacancyWasApproved' => [
            'App\Listeners\Blink\SendVacancyRequiresPostingNotification',
        ],
        'App\Events\Blink\VacancyHasClosed' => [
            //
        ],
        'App\Events\Blink\VacancyWasReceived' => [
            'App\Listeners\Blink\SendSectorApprovalRequiredNotification',
        ],
        'App\Events\Blink\VacancyWasRejected' => [
            'App\Listeners\Blink\SendVacancyRejectedNotification',
        ],
        'App\Events\Blink\VacancyWasDeleted' => [
            'App\Listeners\Blink\NotifyUsersVacancyDeleted',
        ],

        // Classroom
        'App\Events\Classroom\UserWasAddedToScheduledCourse' => [
            'App\Listeners\Classroom\CreateLearningAgreement',
            'App\Listeners\Classroom\SendRegistrationConfirmationNotification',
            // 'App\Listeners\Classroom\NotifyTrainerNewAttendee',
        ],

        'App\Events\Classroom\UserWasRemovedFromScheduledCourse' => [
            'App\Listeners\Classroom\RemoveUserLearningAgreement',
            'App\Listeners\Classroom\SendUnregisteredConfirmationNotification'
            // 'App\Listeners\Classroom\NotifyTrainerAttendeeRemovedFromCourse'
        ],

        'App\Events\Classroom\UserAttendedCourse' => [
            // 'App\Listeners\Classroom\UserAttendedCourseNotification' // cc manager
        ],

        'App\Events\Classroom\UserWasAbsentFromCourse' => [
            'App\Listeners\Classroom\UserAbsentFromCourseNotification',
        ],

        'App\Events\Classroom\ScheduledCourseWasUpdated' => [
            'App\Listeners\Classroom\CourseUpdateNotification',
        ],

        // Eportfolio
        'App\Events\Eportfolios\AccountWasCreated' => [
            'App\Listeners\Eportfolios\LearnerWelcomeNotification',
        ],

        // Forum
        'App\Events\Forum\ThreadHasNewReply' => [
            'App\Listeners\Forum\NotifyThreadSubscribers',
        ],
        'App\Events\Forum\ThreadWasPublished' => [
            'App\Listeners\Forum\NotifyChannelSubscribers',
        ],

        // Judi
        'App\Events\Judi\SummaryWasSubmitted' => [
            'App\Listeners\Judi\NotifySectorManagerAllUserAssessmentsSubmitted',
            'App\Listeners\Judi\ActivityReportReminder',
            'App\Listeners\Judi\FailedAssessmentNotification',
            'App\Listeners\Judi\InsufficientEvidenceNotification',
            'App\Listeners\Judi\CreateReassessment',
        ],
        'App\Events\Judi\SectorAssessmentsWerePlanned' => [
            'App\Listeners\Judi\NotifyJudiAdminOfSectorAssessments',
        ],
        'App\Events\Judi\SummaryOutcomeWasSubmitted' => [
            'App\Listeners\Judi\OutcomeSummaryNotification',
        ],

        // UserManager
        'App\Events\UserManager\ProbationEndDateWasUpdated' => [
            'App\Listeners\UserManager\ProbationWasEndedNotification',
            'App\Listeners\UserManager\ProbationWasExtendedNotification',
        ],
        'App\Events\UserManager\UserMembershipsWereUpdated' => [
            'App\Listeners\Judi\CheckUserHasRequiredAssessments',
            'App\Listeners\UserManager\SendNotificationsOfDepartmentChange',
            //
        ],
        'App\Events\UserManager\UserWasDeleted' => [
            //
        ],
        'App\Events\UserManager\UserWasRegistered' => [
            'App\Listeners\UserManager\SendNewUserNotificationToManager',
            // 'App\Listeners\UserManager\CreateInductionPlan',
        ],
        'App\Events\UserManager\UserWasUpdated' => [
            'App\Listeners\UserManager\UpdateUserMeta',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
