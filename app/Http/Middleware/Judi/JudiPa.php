<?php

namespace App\Http\Middleware\Judi;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class JudiPa
{
    /**
     * @var Guard
     */
    protected $auth;

    /**
     * JudiPa constructor.
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

        if ($user->hasAccess('judiAdmin') || $user->hasAccess('judiPa')) {
            return $next($request);
        }

        return redirect()->back()->with('error', 'Sorry you do not have permission to view this page.');
    }

}
