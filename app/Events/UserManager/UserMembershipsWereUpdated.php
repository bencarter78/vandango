<?php
namespace App\Events\UserManager;

use App\Events\Event;
use App\UserManager\Users\User;
use Illuminate\Queue\SerializesModels;

class UserMembershipsWereUpdated extends Event
{
    use SerializesModels;

    /**
     * @var User
     */
    private $user;

    /**
     * @var null
     */
    private $request;

    /**
     * @var null
     */
    private $memberships;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param null $memberships
     * @param null $request
     */
    public function __construct(User $user, $memberships = null, $request = null)
    {
        $this->user = $user;
        $this->memberships = $memberships;
        $this->request = $request;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return null
     */
    public function getMemberships()
    {
        return $this->memberships;
    }

    /**
     * @return null
     */
    public function getRequest()
    {
        return $this->request;
    }

}
