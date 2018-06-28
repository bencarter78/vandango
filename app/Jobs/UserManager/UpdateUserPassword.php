<?php

namespace App\Jobs\UserManager;

use App\Jobs\Job;
use App\UserManager\Users\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Hashing\BcryptHasher;
use App\Exceptions\PasswordCheckFailureException;
use App\Http\Requests\UserManager\StoreUserRequest;

class UpdateUserPassword extends Job
{
    /**
     * @var StoreUserRequest
     */
    private $request;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @param StoreUserRequest $request
     * @param User             $user
     */
    public function __construct(StoreUserRequest $request, User $user)
    {
        $this->request = $request;
        $this->user = $user;
    }

    /**
     * Execute the command.
     *
     * @param Guard        $auth
     * @param BcryptHasher $hasher
     * @return User
     */
    public function handle(Guard $auth, BcryptHasher $hasher)
    {
        if ($this->authenticate($auth, $hasher)) {
            $this->user->update(['password' => bcrypt($this->request->get('password'))]);
        }

        return $this->user;
    }

    /**
     * @param $auth
     * @param $hasher
     * @return bool
     * @throws PasswordCheckFailureException
     */
    public function authenticate($auth, $hasher)
    {
        if ($hasher->check($this->request->get('oldPassword'), $this->user->password) && ! $auth->user()->hasAccess('admin')) {
            return true;
        }

        throw new PasswordCheckFailureException('Password does not match with the old password, please try again.');
    }
}
