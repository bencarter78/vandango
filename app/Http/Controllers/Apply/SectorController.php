<?php

namespace App\Http\Controllers\Apply;

use Illuminate\Http\Request;
use App\Blink\Models\Opportunity;
use App\Http\Controllers\Controller;
use App\Apply\Repositories\Applicants;
use App\UserManager\Sectors\SectorRepository;

class SectorController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $periods = contractYearPeriods();

        if ($request->has('programme_group')) {
            $group = $request->get('programme_group') == 'all' ? null : $request->get('programme_group');

            if ($group == 'opportunities') {
                $opportunities = Opportunity::all();
                $data = $periods
                    ->map(function ($period) use ($opportunities) {
                        return $opportunities->filter(function ($o) use ($period) {
                            return $o->expected_on->format('Y-m-d') >= $period['start']
                                && $o->expected_on->format('Y-m-d') <= $period['end'];
                        });
                    });
            } else {
                $applicants = $this->applicants->applicantsByProgrammeGroup($group);
                $data = $periods->map(function ($period) use ($applicants) {
                    return $applicants->filter(function ($a) use ($period) {
                        return $a->starting_on->format('Y-m-d') >= $period['start'] &&
                            $a->starting_on->format('Y-m-d') <= $period['end'];
                    });
                });
            }
        }

        return view('apply.sectors.index', [
            'applicants' => isset($applicants) ? $applicants : null,
            'data' => isset($data) ? $data : null,
            'opportunities' => isset($opportunities) ? $opportunities : null,
            'periods' => $periods,
            'sectors' => $this->sectors->getAll('code'),
        ]);
    }

    /**
     * @param         $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id, Request $request)
    {
        $periods = contractYearPeriods();
        
        $group = $request->get('programme_group') == 'all' ? null : $request->get('programme_group');

        if ($group == 'opportunities') {
            $opportunities = Opportunity::where('sector_id', $id)
                                        ->where('expected_on', '>=', $periods[$request->period]['start'])
                                        ->where('expected_on', '<=', $periods[$request->period]['end'])
                                        ->get();
        } else {
            $applicants = $this->applicants->sectorApplicantsByProgrammeGroupInPeriod($id, $request->period, $group);
        }

        return view('apply.sectors.show', [
            'sector' => $this->sectors->requireById($id),
            'applicants' => isset($applicants) ? $applicants : null,
            'opportunities' => isset($opportunities) ? $opportunities : null,
            'periods' => contractYearPeriods(),
        ]);
    }
}
