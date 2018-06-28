<?php

namespace App\Http\Controllers\UserManager;

use App\Http\Controllers\Controller;
use App\UserManager\Users\UserRepository;
use App\UserManager\Users\UpdateCommandTranslator;
use App\Http\Requests\UserManager\StoreUserRequest;

class AccountController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    protected $users;

    /**
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     *  Display this user's details.
     *
     * @param $username
     * @return \Illuminate\View\View
     */
    public function show($username)
    {
        $user = $this->users->findByUsername($username);

        return view('usermanager.users.show', [
            'user' => $user,
            'userDepartmentIds' => $user->departments()->pluck('department_id')->all(),
            'userSectorIds' => $user->sectors()->pluck('sector_id')->all(),
            'userRoleIds' => $user->roles()->pluck('role_id')->all(),
            'userGroupIds' => $user->groups()->pluck('group_id')->all(),
        ]);
    }

    /**
     *  Edit the user
     *
     * @param $username
     * @return \Illuminate\View\View
     */
    public function edit($username)
    {
        $user = $this->users->findByUsername($username);

        return view('usermanager.users.edit', [
            'user' => $user,
            'userDepartmentIds' => $user->departments()->pluck('department_id')->all(),
            'userSectorIds' => $user->sectors()->pluck('sector_id')->all(),
            'userRoleIds' => $user->roles()->pluck('role_id')->all(),
            'userGroupIds' => $user->groups()->pluck('group_id')->all(),
            'pageTitle' => $user->present()->name,
        ]);
    }

    /**
     * @param                  $id
     * @param StoreUserRequest $request
     * @return mixed
     */
    public function update($id, StoreUserRequest $request)
    {
        $command = UpdateCommandTranslator::translate($request->get('ruleset'));

        $user = $this->dispatch(
            new $command($request, $this->users->requireById($id))
        );

        return redirect()->route('account.edit', ['username' => $user->username])
                         ->with('success', 'Profile has been successfully updated.')
                         ->with('ruleset', $request->get('ruleset'));
    }
}