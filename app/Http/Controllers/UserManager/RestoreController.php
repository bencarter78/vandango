<?php

namespace App\Http\Controllers\UserManager;

use App\Core\BaseRepository;
use App\Http\Controllers\Controller;

class RestoreController extends Controller
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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($resource, $id)
    {
        if ( ! array_key_exists($resource, $this->allowedModels)) {
            return back()->with('error', 'This resource is not available.');
        }

        $this->repository->setModel(new $this->allowedModels[$resource]);

        if ($this->repository->restoreById($id)) {
            return redirect()->route("$resource.index")
                             ->with('success', "You have successfully restored the {str_singular($resource}.");
        }

        return back()->with(
            'error',
            'Sorry, there was an error with this request. Please try again later.'
        );
    }
}
