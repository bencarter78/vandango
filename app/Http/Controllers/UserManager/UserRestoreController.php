<?php

namespace App\Http\Controllers\UserManager;

use App\Http\Controllers\Controller;
use App\UserManager\Users\UserRepository;

class UserRestoreController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * UserRestoreController constructor.
     *
     * @param $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index($id)
    {
        if ($this->users->restoreById($id)) {
            return redirect()->route('users.index')
                             ->with('success', 'You have successfully restored the user.');
        }

        return back()->with('error', 'Sorry, there was an error with this request. Please try again later.');
    }
}
