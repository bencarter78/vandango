<?php

namespace App\Http\Controllers\Apply;

use App\Http\Controllers\Controller;
use App\Apply\Repositories\Applicants;
use App\UserManager\Sectors\SectorRepository;

class DashboardController extends Controller
{
    /**
     * @var Applicants
     */
    private $applicants;

    /**
     * @var SectorRepository
     */
    protected $sectors;

    /**
     * DashboardController constructor.
     *
     * @param Applicants       $applicants
     * @param SectorRepository $sectors
     */
    public function __construct(Applicants $applicants, SectorRepository $sectors)
    {
        $this->applicants = $applicants;
        $this->sectors = $sectors;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('apply.dashboard');
    }
}
