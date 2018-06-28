<?php

namespace App\Http\ViewComposers\UserManager;

class UserComposer
{
    /**
     * @var
     */
    protected $users;

    /**
     * @param $users
     */
    function __construct($users)
    {
        $this->users = $users;
    }

    /**
     * @param $view
     */
    public function compose($view)
    {
        $view->with('user', $this->users->currentUser());
    }

} 