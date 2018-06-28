<?php

namespace App\UserManager\Groups;

use App\UserManager\Repositories\UserManagerRepository;

class GroupRepository extends UserManagerRepository
{
    /**
     * @var Group
     */
    protected $model;

    /**
     * @param Group $model
     */
    function __construct(Group $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getGroupWithUsers($id)
    {
        return $this->getRelationshipUsers($id);
    }
} 