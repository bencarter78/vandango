<?php

namespace App\Http\Controllers\UserManager;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jobs\UserManager\RegisterUser;
use App\UserManager\Users\UserRepository;
use App\Http\Requests\UserManager\RegisterUserRequest;

class RegistrationController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * RegistrationController constructor.
     *
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usermanager.users.register.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RegisterUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterUserRequest $request)
    {
        $user = $this->dispatch(new RegisterUser($request, $this->users));

        return redirect()->route('account.edit', $user->username);
    }
}
