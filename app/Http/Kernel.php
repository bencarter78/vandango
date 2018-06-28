<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \Barryvdh\Cors\HandleCors::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\UserPageMonitor::class,
            \App\Http\Middleware\LogLastUserActivity::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
            \Barryvdh\Cors\HandleCors::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'jwt.auth' => \Tymon\JWTAuth\Middleware\GetUserFromToken::class,
        'jwt.refresh' => \Tymon\JWTAuth\Middleware\RefreshToken::class,

        /*
         * VanDango
         */
        'auth.isAdmin' => 'App\Http\Middleware\Auth\IsAdmin',
        'auth.isHr' => 'App\Http\Middleware\Auth\IsHr',
        'auth.isManager' => 'App\Http\Middleware\Auth\IsManager',
        'auth.isLineManager' => 'App\Http\Middleware\Auth\IsLineManager',
        'auth.isUser' => 'App\Http\Middleware\Auth\IsUser',
        'auth.canEditUser' => 'App\Http\Middleware\Auth\CanEditUser',

        // Auditor
        'auditor' => 'App\Http\Middleware\Auditor\Auditor',
        'auditor.admin' => 'App\Http\Middleware\Auditor\AuditorAdmin',

        // Judi
        'judi' => 'App\Http\Middleware\Judi\Judi',
        'judi.admin' => 'App\Http\Middleware\Judi\JudiAdmin',
        'judi.pa' => 'App\Http\Middleware\Judi\JudiPa',
        'judi.canEditAssessment' => 'App\Http\Middleware\Judi\CanEditAssessment',

        // Reports
        'reportsAdmin' => 'App\Http\Middleware\Reports\ReportsAdmin',

        // SurveyHound
        'surveyHoundAdmin' => 'App\Http\Middleware\SurveyHound\SurveyHoundAdmin',
    ];
}
