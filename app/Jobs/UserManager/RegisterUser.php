<?php

namespace App\Jobs\UserManager;

use App\Jobs\Job;
use App\UserManager\Users\Account;
use App\UserManager\Users\UserRepository;
use App\Events\UserManager\UserWasRegistered;
use App\Exceptions\UserEmailAlreadyExistsException;
use App\Http\Requests\UserManager\RegisterUserRequest;

class RegisterUser extends Job
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var RegisterUserRequest
     */
    private $request;

    /**
     * Create a new job instance.
     *
     * @param RegisterUserRequest $request
     * @param UserRepository      $users
     */
    public function __construct(RegisterUserRequest $request, UserRepository $users)
    {
        $this->users = $users;
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @param Account $account
     * @return mixed
     */
    public function handle(Account $account)
    {
        if ( ! $this->isRegisteredEmail($this->request->get('email'))) {
            $user = $this->createUser($account);
            event(new UserWasRegistered($user));

            return $user;
        }
    }

    /**
     * @param null $email
     * @throws UserEmailAlreadyExistsException
     */
    public function isRegisteredEmail($email = null)
    {
        if ($this->users->findByEmail($email)) {
            throw new UserEmailAlreadyExistsException('The email address is already in use.');
        }
    }

    /**
     * @param Account $account
     * @return mixed
     */
    public function createUser(Account $account)
    {
        return $account->create($this->request->all());
    }
}
