<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        view()->composers([
            /*
             * Global
             */
            'App\Http\ViewComposers\GlobalComposer' => ['*'],

            /*
             * General
             */

            // Applications
            'App\Http\ViewComposers\ApplicationsComposer' => [
                'partials/nav/_subnav', 'partials/_sidebar', 'dashboard', 'usermanager/partials/_expenses',
            ],

            // Centres
            'App\Http\ViewComposers\Locations\CentresComposer' => ['usermanager/partials/_expenses'],

            // Forum
            'App\Http\ViewComposers\Forum\ChannelsComposer' => ['forum/partials/_channels'],
            'App\Http\ViewComposers\Forum\TrendingComposer' => ['forum/partials/_trending'],

            /*
             * Judi
             */
            // Cancellation Reasons
            'App\Http\ViewComposers\Judi\CancellationComposer' => ['judi/assessments/partials/_delete'],

            // Processes
            'App\Http\ViewComposers\Judi\ProcessComposer' => [
                'judi/assessors/edit', 'judi/assessments/partials/_user-settings', 'judi/partials/_filter',
                'judi/analysis/_partials/_filter', 'judi/partials/_summaries-summarised',
            ],

            // Grades
            'App\Http\ViewComposers\Judi\GradeComposer' => [
                'judi/summaries/partials/_form', 'judi/partials/_filter', 'judi/analysis/_partials/_filter',
                'judi/analysis/_partials/_summaries-summarised',
            ],

            // Criteria
            'App\Http\ViewComposers\Judi\CriteriaComposer' => [
                'judi/summaries/partials/_form', 'judi/partials/_filter', 'judi/analysis/_partials/_filter',
            ],

            // PA Documents
            'App\Http\ViewComposers\Judi\DocumentComposer' => ['judi/partials/_nav'],

            /*
             * UserManager
             */

            // Departments
            'App\Http\ViewComposers\UserManager\DepartmentComposer' => [
                'usermanager/partials/_departments', 'usermanager/sectors/partials/_form', 'usermanager/import',
            ],

            // Directors
            'App\Http\ViewComposers\UserManager\RoleDirectorsComposer' => [
                'usermanager/departments/partials/_form',
            ],

            // Functions
            'App\Http\ViewComposers\UserManager\RoleFunctionComposer' => [
                'usermanager/partials/_functions',
            ],

            // Groups
            'App\Http\ViewComposers\UserManager\GroupComposer' => [
                'usermanager/partials/_groups',
            ],

            // Managers
            'App\Http\ViewComposers\UserManager\RoleManagersComposer' => [
                'usermanager/departments/partials/_form',
            ],

            // Roles
            'App\Http\ViewComposers\UserManager\RoleComposer' => [
                'judi/processes/partials/_form', 'usermanager/partials/_roles',
            ],

            // Sectors
            'App\Http\ViewComposers\UserManager\SectorComposer' => [
                'usermanager/partials/_sectors', 'usermanager/import',
                'judi/assessments/create', 'judi/partials/_filter', 'judi/analysis/_partials/_filter',
            ],
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
