<?php

namespace App\Http\Middleware\Auth;

use Closure;
use App\UserManager\Users\UserAuthorisation;

class CanEditUser
{
    /**
     * @var UserAuthorisation
     */
    protected $userAuth;

    /**
     * CanEditUser constructor.
     *
     * @param UserAuthorisation $userAuth
     */
    function __construct(UserAuthorisation $userAuth)
    {
        $this->userAuth = $userAuth;
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
        if ( ! $this->userAuth->canEditUser($request->segment(3))) {
            return redirect()->back()->with('error', 'Sorry you do not have permission to view this page.');
        }

        return $next($request);
    }

}
