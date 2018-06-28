<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redis;

class LogLastUserActivity
{
    /**
     * @var Guard
     */
    protected $auth;

    /**
     * Auditor constructor.
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
        if ($this->auth->check()) {
            $key = 'users.online.' . $this->auth->user()->id;
            Redis::set($key, true);
            Redis::expire($key, 600);
        }

        return $next($request);
    }
}
