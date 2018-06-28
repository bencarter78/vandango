<?php

namespace App\Http\Controllers\UserManager;

use App\Core\BaseRepository;
use App\Http\Controllers\Controller;

class TrashController extends Controller
{
    /**
     * @var BaseRepository
     */
    private $repository;

    /**
     * @var array
     */
    private $allowedModels = [
        'departments' => 'App\UserManager\Departments\Department',
        'groups' => 'App\UserManager\Groups\Group',
        'roles' => 'App\UserManager\Roles\Role',
        'sectors' => 'App\UserManager\Sectors\Sector',
    ];

    /**
     * TrashController constructor.
     *
     * @param $repository
     */
    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $resource
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($resource)
    {
        if ( ! array_key_exists($resource, $this->allowedModels)) {
            return back()->with('error', 'This resource is not available.');
        }

        $this->repository->setModel(new $this->allowedModels[$resource]);

        // TODO: Sort the results by some kind of primary key, maybe via url
        return view('usermanager.trashed', [
                'results' => $this->repository->getAllTrashedPaginated(),
                'title' => ucfirst($resource),
            ]
        );
    }
}
