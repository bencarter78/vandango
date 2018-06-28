<?php

namespace App\Http\Controllers\Api\V1\UserManager;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserManager\Sectors\SectorRepository;

class SectorController extends Controller
{
    /**
     * @var SectorRepository
     */
    protected $sectors;

    /**
     * SectorController constructor.
     *
     * @param $sectors
     */
    public function __construct(SectorRepository $sectors)
    {
        $this->sectors = $sectors;
    }

    /**
     * @param Request $request
     * @return \App\UserManager\Sectors\User|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index(Request $request)
    {
        if ($request->has('sector')) {
            return $this->sectors->searchByName($request->get('sector'));
        }

        return $this->sectors->getAll()->load('department', 'department.manager', 'department.ad');
    }

}
