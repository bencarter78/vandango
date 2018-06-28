<?php

namespace App\Http\Middleware\Auditor;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AuditorAdmin
{
    /**
     * @var Guard
     */
    protected $auth;

    /**
     * AuditorAdmin constructor.
     *
     * @param Guard $auth
     */
    function __construct(Guard $auth)
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
        $user = $this->auth->user();
        if ( ! $user->hasAccess('auditorAdmin')) {
            return redirect()->back()->with('error', 'Sorry you do not have permission to view this page.');
        }

        return $next($request);
    }

}
