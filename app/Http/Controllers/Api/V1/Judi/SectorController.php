<?php

namespace App\Http\Controllers\Api\V1\Judi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Judi\Repositories\UserRepository;
use App\Judi\Repositories\SectorRepository;

class SectorController extends Controller
{
    /**
     * @var SectorRepository
     */
    protected $sectors;

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * SectorController constructor.
     *
     * @param SectorRepository $sectors
     * @param UserRepository   $users
     */
    public function __construct(SectorRepository $sectors, UserRepository $users)
    {
        $this->sectors = $sectors;
        $this->users = $users;
    }

    /**
     * @param Request $request
     * @return \App\UserManager\Sectors\User|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index(Request $request)
    {
        if ( ! $request->has('user')) {
            return response('You are not authorised to view this resource.', 403);
        }

        $user = $this->users->requireById($request->get('user'));

        if ($user->hasAccess('judiSM') && ! $user->hasAccess('judiAdmin')) {
            return $user->departments->map(function ($department) {
                return $department->sectors;
            })->flatten();
        }

        if ($request->has('sector')) {
            return $this->sectors->searchByName($request->get('sector'));
        }

        return $this->sectors->getAll()->load('schedule');
    }

}
