<?php

namespace App\Judi\Repositories;

use App\Judi\Models\Role;
use App\UserManager\Roles\RoleRepository as BaseRoleRepository;

class RoleRepository extends BaseRoleRepository
{
    /**
     * @var Role
     */
    protected $model;

    /**
     * @param Role $model
     */
    function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getPaRoles()
    {
        return $this->model->has('processes')->groupBy('id')->get();
    }

    /**
     * @param Role $role
     * @return mixed
     */
    public function getProcesses(Role $role)
    {
        return $role->processes;
    }

}