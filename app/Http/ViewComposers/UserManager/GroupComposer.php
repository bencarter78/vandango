<?php

namespace App\Http\ViewComposers\UserManager;

use App\UserManager\Groups\GroupRepository;

class GroupComposer
{
    /**
     * @var GroupRepository
     */
    protected $groups;

    /**
     * @param GroupRepository $groups
     */
    function __construct(GroupRepository $groups)
    {
        $this->groups = $groups;
    }

    /**
     * @param $view
     */
    public function compose($view)
    {
        $view->with('groups', $this->groups->getAll('name'));
    }

} 