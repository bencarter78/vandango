<?php

namespace App\Http\Middleware\Auth;

use Closure;
use App\Judi\Users\UserRepository;
use Illuminate\Contracts\Auth\Guard;

class IsLineManager
{
    /**
     * @var
     */
    protected $auth;

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @param Guard          $auth
     * @param UserRepository $users
     */
    function __construct(Guard $auth, UserRepository $users)
    {
        $this->auth = $auth;
        $this->users = $users;
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
        $requestedUser = $this->users->requireById($request->segment(3));
        if ( ! isLineManager($user->id, $requestedUser) && ! $user->hasAccess('judiAdmin')) {
            return redirect()->back()->with('error', 'Sorry you do not have permission to view this page.');
        }

        return $next($request);
    }

}
