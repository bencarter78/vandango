<?php

namespace App\Http\Middleware\Auth;

use Closure;
use App\Judi\Users\UserRepository;
use Illuminate\Contracts\Auth\Guard;

class IsManager
{
    /**
     * @var
     */
    protected $auth;

    /**
     * @param Guard          $auth
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
        if ( ! $this->auth->user()->isManager()) {
            return redirect()->back()->with('error', 'Sorry you do not have permission to view this page.');
        }

        return $next($request);
    }

}
