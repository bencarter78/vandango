<?php

namespace App\Http\Middleware;

use App\Models\Monitor;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class UserPageMonitor
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
        if ($this->auth->user()) {
            Monitor::create([
                'user_id' => $this->auth->user()->id,
                'url' => $request->url(),
                'ip' => $request->ip(),
                'user-agent' => $request->header('User-Agent'),
            ]);
        }

        return $next($request);
    }
}
