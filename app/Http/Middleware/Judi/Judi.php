<?php

namespace App\Http\Middleware\Judi;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Judi
{
    /**
     * @var Guard
     */
    protected $auth;

    /**
     * Judi constructor.
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
        if ($this->auth->user()->hasAccess('judi')) {
            return $next($request);
        }

        return redirect()->back()->with('error', 'Sorry you do not have permission to view this page.');
    }

}
