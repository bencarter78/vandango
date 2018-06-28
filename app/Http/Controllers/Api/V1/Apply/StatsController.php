<?php

namespace App\Http\Controllers\Api\V1\Apply;

use Carbon\Carbon;
use App\Apply\Models\Sector;
use App\Apply\Models\Applicant;
use App\Http\Controllers\Controller;

class StatsController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $applicants = Applicant::with('sector', 'submittedBy')->get();
        $sectorApplicants = Sector::with('applicants')->get();

        return $this->response([
            'weeklyCount' => $applicants->where('created_at', '>=', Carbon::now()->startOfWeek())->count(),
            'lastWeekCount' => $applicants->where('created_at', '>=', Carbon::now()->subWeek()->startOfWeek())->where('created_at', '<', Carbon::now()->startOfWeek())->count(),
            'monthlyCount' => $applicants->where('created_at', '>=', Carbon::now()->startOfMonth())->count(),
            'lastMonthCount' => $applicants->where('created_at', '>=', Carbon::now()->subMonth()->startOfMonth())->where('created_at', '<', Carbon::now()->subMonth()->endOfMonth())->count(),
            'sectors' => $applicants
                ->where('created_at', '>=', Carbon::now()->startOfMonth())
                ->groupBy('sector_id')
                ->map(function ($group) {
                    return ['name' => $group->first()->sector->name, 'total' => $group->count()];
                })
                ->sortByDesc('total')
                ->values()
                ->take(5),
            'weeklySectors' => $sectorApplicants->map(function ($sector) {
                return [
                    'code' => $sector->code,
                    'name' => $sector->name,
                    'total' => $sector->applicants->filter(function ($applicant) {
                        return $applicant->created_at >= Carbon::now()->subWeek()->startOfWeek() &&
                            $applicant->created_at < Carbon::now()->startOfWeek();
                    })->count(),
                ];
            })->sortBy('code'),
            'monthlySectors' => $sectorApplicants->map(function ($sector) {
                return [
                    'code' => $sector->code,
                    'name' => $sector->name,
                    'total' => $sector->applicants->filter(function ($applicant) {
                        return $applicant->created_at >= Carbon::now()->startOfMonth();
                    })->count(),
                ];
            })->sortBy('code'),
            'users' => $applicants
                ->where('created_at', '>=', Carbon::now()->startOfMonth())
                ->groupBy('user_id')
                ->map(function ($group) {
                    return ['name' => $group->first()->submittedBy->fullName, 'total' => $group->count()];
                })
                ->sortByDesc('total')
                ->values()
                ->take(5),
            'picsUsers' => $applicants
                ->where('created_at', '>=', Carbon::now()->startOfMonth())
                ->where('episode_ident', '!=', null)
                ->groupBy('user_id')
                ->map(function ($group) {
                    return ['name' => $group->first()->submittedBy->fullName, 'total' => $group->count()];
                })
                ->sortByDesc('total')
                ->values()
                ->take(5),
            'picsSectors' => $applicants
                ->where('created_at', '>=', Carbon::now()->startOfMonth())
                ->where('episode_ident', '!=', null)
                ->groupBy('sector_id')
                ->map(function ($group) {
                    return ['name' => $group->first()->sector->name, 'total' => $group->count()];
                })
                ->sortByDesc('total')
                ->values()
                ->take(5),
            'unconverted' => $applicants
                ->where('starting_on', '<=', Carbon::now()->subWeeks(4))
                ->where('episode_ident', null)
                ->groupBy('sector_id')
                ->map(function ($group) {
                    return ['name' => $group->first()->sector->name, 'total' => $group->count()];
                })
                ->sortByDesc('total')
                ->values()
                ->take(5),
            'programmes' => $applicants
                ->where('starting_on', '>=', '2017-08-01')
                ->groupBy('programme_type')
                ->map(function ($group) {
                    return ['name' => $group->first()->programme_type, 'total' => $group->count()];
                })
                ->sortByDesc('total')
                ->values(),
            'programmesWeekly' => $applicants
                ->where('created_at', '>=', Carbon::now()->subWeek()->startOfWeek())
                ->where('created_at', '<', Carbon::now()->startOfWeek())
                ->groupBy('programme_type')
                ->map(function ($group) {
                    return ['name' => $group->first()->programme_type, 'total' => $group->count()];
                })
                ->sortByDesc('total')
                ->values(),
            'programmesMonthly' => $applicants
                ->where('starting_on', '>=', Carbon::now()->startOfMonth())
                ->where('starting_on', '<=', Carbon::now()->endOfMonth())
                ->groupBy('programme_type')
                ->map(function ($group) {
                    return ['name' => $group->first()->programme_type, 'total' => $group->count()];
                })
                ->sortByDesc('total')
                ->values(),
            'programmesPics' => $applicants
                ->where('starting_on', '>=', '2017-08-01')
                ->where('episode_ident', '!=', null)
                ->groupBy('programme_type')
                ->map(function ($group) {
                    return ['name' => $group->first()->programme_type, 'total' => $group->count()];
                })
                ->sortByDesc('total')
                ->values(),
            'contractYear' => ['start' => contractYearPeriods()[1]['start'], 'end' => contractYearPeriods()[12]['end']],
        ]);
    }
}
