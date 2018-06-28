<?php

namespace App\UserManager\Users;

use Illuminate\Auth\AuthManager;

class UserAuthorisation
{
    /**
     * The user groups with global access to user accounts
     *
     * @var array
     */
    private $globalAccess = ['admin', 'hr'];

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var AuthManager
     */
    private $auth;

    /**
     * @param UserRepository $users
     * @param AuthManager    $auth
     */
    function __construct(UserRepository $users, AuthManager $auth)
    {
        $this->users = $users;
        $this->auth = $auth;
    }

    /**
     * Determines whether the current user can access a given user's profile
     * $editableUser is generated from a URI Segment which will be an ID or
     * Username
     *
     * @param $editableUser
     * @return bool
     */
    public function canEditUser($editableUser)
    {
        $currentUser = $this->auth->user();

        return $this->isSelf($editableUser, $currentUser) ||
        $this->hasGlobalUserAccess($currentUser) ||
        $this->isLineManager($editableUser, $currentUser);
    }

    /**
     * Determines if the user is requesting permission to their own account.
     *
     * @param $editableUser
     * @param $currentUser
     * @return bool
     */
    public function isSelf($editableUser, $currentUser)
    {
        return $currentUser->id == $editableUser || $currentUser->username == $editableUser;
    }

    /**
     * @param $currentUser
     * @return bool
     */
    public function hasGlobalUserAccess($currentUser)
    {
        foreach ($this->globalAccess as $access) {
            if ($currentUser->hasAccess($access)) {
                return true;
            }
        }
    }

    /**
     * Determines if the requestor is the line manager
     *
     * @param $editableUser
     * @param $currentUser
     * @return bool
     */
    public function isLineManager($editableUser, $currentUser)
    {
        $user = $this->users->findByIdOrUsername($editableUser);

        return in_array($currentUser->id, $user->getLineManagers()->toArray());
    }

}