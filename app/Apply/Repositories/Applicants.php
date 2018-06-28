<?php

namespace App\Apply\Repositories;

use App\Core\BaseRepository;
use App\Apply\Models\Applicant;

class Applicants extends BaseRepository
{
    /**
     * @var Applicant
     */
    protected $model;

    /**
     * Applicants constructor.
     *
     * @param $model
     */
    public function __construct(Applicant $model)
    {
        $this->model = $model;
    }

    /**
     * @param array|null $group
     * @return mixed
     */
    public function applicantsByProgrammeGroup($group = null)
    {
        $periods = contractYearPeriods();

        $applicants = $this->model
            ->with('sector')
            ->where('starting_on', '>=', $periods->first()['start'])
            ->where('starting_on', '<=', $periods->last()['end']);

        if ($group) {
            $applicants->whereIn('programme_type', programmeGroups()[$group]);
        }

        return $applicants->get();
    }

    /**
     * @param      $sectorId
     * @param      $period
     * @param null $group
     * @return mixed
     */
    public function sectorApplicantsByProgrammeGroupInPeriod($sectorId, $period, $group = null)
    {
        $periods = contractYearPeriods();

        $applicants = $this->model
            ->where('sector_id', $sectorId)
            ->where('starting_on', '>=', $periods[$period]['start'])
            ->where('starting_on', '<=', $periods[$period]['end']);

        if ($group) {
            $applicants->whereIn('programme_type', programmeGroups()[$group]);
        }

        return $applicants->orderBy('user_id')
                          ->orderBy('starting_on')
                          ->get();
    }
}