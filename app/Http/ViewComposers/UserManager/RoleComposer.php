<?php

namespace App\Http\ViewComposers\UserManager;

use App\UserManager\Roles\RoleRepository;

class RoleComposer
{
    /**
     * @var RoleRepository
     */
    protected $roles;

    /**
     * @param RoleRepository $roles
     */
    function __construct(RoleRepository $roles)
    {
        $this->roles = $roles;
    }

    /**
     * @param $view
     */
    public function compose($view)
    {
        $view->with('roles', $this->roles->getAll('job_role'));
    }

}