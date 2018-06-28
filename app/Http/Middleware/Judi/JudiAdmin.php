<?php

namespace App\Http\Middleware\Judi;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class JudiAdmin
{
    /**
     * @var Guard
     */
    protected $auth;

    /**
     * JudiAdmin constructor.
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
        if ($this->auth->user()->hasAccess('judiAdmin')) {
            return $next($request);
        }

        return back()->with('error', 'Sorry you do not have permission to view this page.');
    }

}
