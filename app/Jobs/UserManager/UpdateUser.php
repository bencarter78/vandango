<?php

namespace App\Jobs\UserManager;

use App\Jobs\Job;
use App\UserManager\Users\User;
use App\Events\UserManager\UserWasUpdated;
use App\Http\Requests\UserManager\StoreUserRequest;

class UpdateUser extends Job
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
     * Handle the command.
     *
     * @return User
     */
    public function handle()
    {
        $this->user->update([
            'first_name' => $this->request->get('first_name'),
            'surname' => $this->request->get('surname'),
            'email' => $this->request->get('email'),
            'username' => $this->request->get('email'),
        ]);

        event(new UserWasUpdated($this->user, $this->request));

        return $this->user;
    }
}
