<?php

namespace App\Http\Middleware\SurveyHound;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class SurveyHoundAdmin
{
    /**
     * @var Guard
     */
    protected $auth;

    /**
     * SurveyHoundAdmin constructor.
     *
     * @param $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->user()->hasAccess('surveyHoundAdmin')) {
            return $next($request);
        }

        return redirect()->back()->with('error', 'Sorry you do not have permission to view this page.');
    }
}
