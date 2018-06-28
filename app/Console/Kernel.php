<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

        // General
        \App\Console\Commands\DbExporter::class,
        \App\Console\Commands\Broadcaster::class,
        \App\Console\Commands\OnlineUsers::class,
        \App\Console\Commands\SetGlobalMessage::class,
        \App\Console\Commands\StartChecker::class,

        // Apply
        \App\Console\Commands\Apply\ExportApplicants::class,
        \App\Console\Commands\Apply\ImportLearners::class,
        \App\Console\Commands\Apply\InvitationStatus::class,
        \App\Console\Commands\Apply\UnmatchedApplicantNotification::class,

        // Auditor
        \App\Console\Commands\Auditor\Manager::class,

        // AvA
        //        \App\Console\Commands\Ava\FetchNewApplications::class,

        // Blink
        \App\Console\Commands\Blink\CheckForUnapprovedVacancies::class,
        \App\Console\Commands\Blink\CheckForUnassignedEnquiries::class,
        \App\Console\Commands\Blink\DeleteCompletedEnquiries::class,
        \App\Console\Commands\Blink\ExportVacancies::class,
        \App\Console\Commands\Blink\FetchVacancies::class,
        \App\Console\Commands\Blink\ImportNasVacancy::class,
        \App\Console\Commands\Blink\ImportPortalEnquiries::class,
        \App\Console\Commands\Blink\NotifyOwnersQualifiedEnquiryHasNoRecordedStreams::class,
        \App\Console\Commands\Blink\NotifyUsersSubmittedVacancyLive::class,
        \App\Console\Commands\Blink\NotifyUsersVacancyHasClosed::class,
        \App\Console\Commands\Blink\OverdueUnqualifiedEnquiryReminder::class,
        \App\Console\Commands\Blink\ProgressUnqualifiedEnquiries::class,
        \App\Console\Commands\Blink\Fixes\UpdateEnquiryOwner::class,

        // Classroom
        \App\Console\Commands\Classroom\CourseReminder::class,

        // CPD
        \App\Console\Commands\Cpd\ImportCpd::class,

        // Datastore
        \App\Console\Commands\Datastore\MailCleanser::class,

        // Eportfolios
        \App\Console\Commands\Eportfolio\ArchiveOneFileAccounts::class,
        \App\Console\Commands\Eportfolio\FetchCentres::class,
        \App\Console\Commands\Eportfolio\Registration::class,

        // Forum
        \App\Console\Commands\Forum\ImportSuggestions::class,

        // Judi
        \App\Console\Commands\Judi\AssessmentAlmostDueNotifier::class,
        \App\Console\Commands\Judi\AssessmentGenerator::class,
        \App\Console\Commands\Judi\AssessmentNotifier::class,
        \App\Console\Commands\Judi\CaseloadOverdueNotifier::class,
        \App\Console\Commands\Judi\CaseloadMonthlyNotifier::class,
        \App\Console\Commands\Judi\ConvertJudiSummaryCriteriaGrades::class,
        \App\Console\Commands\Judi\CheckAssessmentHasValidAssessor::class,
        \App\Console\Commands\Judi\SendInLearningList::class,
        \App\Console\Commands\Judi\StaffPaNotifier::class,
        \App\Console\Commands\Judi\SubcontractorPaCheck::class,

        // KeyAssign
        \App\Console\Commands\KeySafe\KeyAssign::class,

        // Mailbox
        \App\Console\Commands\Mailbox\Bounced::class,

        // NAS
        \App\Console\Commands\Nas\MailVacancies::class,
        \App\Console\Commands\Nas\SyncVacancies::class,
        \App\Console\Commands\Nas\SyncCounties::class,
        \App\Console\Commands\Nas\SyncErrorCodes::class,
        \App\Console\Commands\Nas\SyncFrameworks::class,
        \App\Console\Commands\Nas\SyncLocalAuthorities::class,
        \App\Console\Commands\Nas\SyncRegions::class,
        \App\Console\Commands\Nas\VacancyDetail::class,

        // PICS
        \App\Console\Commands\Pics\CheckForStarts::class,
        \App\Console\Commands\Pics\RegisterApplicant::class,
        \App\Console\Commands\Pics\SyncQualificationPlans::class,
        \App\Console\Commands\Pics\RecoverMiscalculatedDuplicateStarts::class,

        // SurveyHound
        \App\Console\Commands\SurveyHound\Surveyor::class,

        // Testing
        \App\Console\Commands\Testing\UserPasswordReset::class,
        \App\Console\Commands\Testing\ReportChecker::class,

        // UserManager
        \App\Console\Commands\UserManager\UserImporter::class,
        \App\Console\Commands\UserManager\UserRemover::class,
        \App\Console\Commands\UserManager\UserTransfer::class,
        \App\Console\Commands\UserManager\ProbationNotifier::class,
        \App\Console\Commands\UserManager\AppraisalNotifier::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Apply
        $schedule->command('apply:export esf')->mondays()->at('08:05');
        $schedule->command('apply:notify-unmatched')->wednesdays()->at('08:05');

        // Auditor - Using the new control flow
        $schedule->command('audit:run --frequency=minute')->everyMinute();
        $schedule->command('audit:run --frequency=hour')->hourly();
        $schedule->command('audit:run --frequency=day')->dailyAt('07:00');
        $schedule->command('audit:run --frequency=week')->mondays()->at('07:05');
        $schedule->command('audit:run --frequency=month')->monthly();
        $schedule->command('audit:run --frequency=year')->yearly();

        // Back Ups
        $schedule->command('backup:clean')->daily()->at('01:00');
        $schedule->command('backup:run --only-db')->daily()->at('01:30');
        $schedule->command('backup:run')->daily()->at('02:00');

        // Blink
        $schedule->command('blink:enquiries-unassigned')
                 ->everyTenMinutes()
                 ->weekdays()
                 ->between('08:30', '17:00');

        $schedule->command('blink:unqualified-reminder')->thursdays()->at('09:15');
        $schedule->command('blink:qualified-empty-streams-notification')->thursdays()->at('09:30');

        $schedule->command('blink:vacancies-unapproved')
                 ->everyThirtyMinutes()
                 ->weekdays()
                 ->between('08:30', '17:00');

        $schedule->command('blink:vacancies-gone-live')->daily()->at('08:15');

        $schedule->command('blink:vacancies-closed')->daily()->at('08:47');

        // Classroom
        $schedule->command('classroom:reminder')->dailyAt('10:25');

        // Datastore
        $schedule->command('datastore:mail-cleanse learner --tags="survey"')->dailyAt('03:30');

        // Eportfolios
        $schedule->command('onefile:fetch-centres')->dailyAt('04:40');
        $schedule->command('onefile:register')->hourly();

        // Judi
        $schedule->command('judi:generate')->monthly();
        $schedule->command('judi:sendInLearning')->monthly();
        $schedule->command('judi:overdue')->weekly();
        $schedule->command('judi:dueInMonth')->monthly();
        $schedule->command('judi:almostDue')->weekly();
        $schedule->command('judi:notify')->monthly();
        $schedule->command('judi:notify-staff')->monthly();
        $schedule->command('judi:check-subcontractor')->monthly();

        // KeySafe
        $schedule->command('key:assign')->daily()->at('11:00');

        // Mailbox
        $schedule->command('mailbox:bounced')->hourly();

        // NAS
        $schedule->command('nas:sync-counties')->daily()->at('11:30');
        $schedule->command('nas:sync-errors')->daily()->at('11:31');
        $schedule->command('nas:sync-frameworks')->daily()->at('11:32');
        $schedule->command('nas:sync-las')->daily()->at('11:33');
        $schedule->command('nas:sync-regions')->daily()->at('11:34');
        $schedule->command('nas:sync-vacancies')->daily()->at('23:00');
        $schedule->command('nas:vacancies-mail')->mondays()->at('9:15');

        // Pics
        $schedule->command('pics:check-starts')->dailyAt('22:00');
        $schedule->command('pics:sync-qual-plans')->dailyAt('22:30');

        // SurveyHound
        $schedule->command('surveyor:send --frequency=day')->dailyAt('10:00');
        $schedule->command('surveyor:send --frequency=week')->mondays()->at('10:05');
        $schedule->command('surveyor:send --frequency=month')->monthly();

        // UserManager
        $schedule->command('users:import')->dailyAt('03:00');
        $schedule->command('users:probation month')->monthly();
        $schedule->command('users:appraisal')->monthly();
        $schedule->command('users:probation today')->dailyAt('04:00');
        $schedule->command('users:remove')->dailyAt('05:00');
        $schedule->command('users:transfer')->dailyAt('06:00');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
