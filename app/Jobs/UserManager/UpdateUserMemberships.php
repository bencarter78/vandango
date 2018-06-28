<?php

namespace App\Jobs\UserManager;

use App\Jobs\Job;
use App\UserManager\Users\User;
use App\Http\Requests\UserManager\StoreUserRequest;
use App\Events\UserManager\UserMembershipsWereUpdated;

class UpdateUserMemberships extends Job
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
     * @return UserRepository
     */
    public function handle()
    {
        $memberships = $this->user->{$this->request->get('ruleset')};
        $this->updateMemberships($this->user, $this->request);
        event(new UserMembershipsWereUpdated($this->user, $memberships, $this->request));

        return $this->user;
    }

    /**
     * Updates the user's Group, Department and Sector Memberships status.
     *
     * @param $user
     * @param $request
     * @return mixed
     */
    public function updateMemberships($user, $request)
    {
        $membership = $this->getMembership($request);
        $user->{$membership['relationship']}()->sync($this->getSyncArray($request, $membership['key']));
    }

    /**
     * @param $request
     * @param $key
     * @return array
     */
    public function getSyncArray($request, $key)
    {
        return $request->get($key) ?: [];
    }

    /**
     * @param $request
     * @return string
     */
    public function getMembership($request)
    {
        return [
            'key' => substr($request->get('ruleset'), 0, - 1) . '_id',
            'relationship' => $request->get('ruleset')
        ];
    }

}
