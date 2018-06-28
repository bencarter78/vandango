<?php

namespace App\Http\Controllers\UserManager;

use App\Http\Controllers\Controller;
use App\UserManager\Groups\GroupRepository;

class GroupController extends Controller
{
    /**
     * @var
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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('usermanager.groups.index', [
            'groups' => $this->groups->getAll('name'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $group = $this->groups->getGroupWithUsers($id);

        return view('usermanager.groups.show', [
            'users' => $group->users->sortBy('first_name'),
            'group' => $group,
        ]);
    }
}
