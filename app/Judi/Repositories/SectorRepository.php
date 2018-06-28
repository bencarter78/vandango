<?php

namespace App\Judi\Repositories;

use App\Judi\Models\Sector;
use App\Judi\Models\SectorSchedule;
use App\UserManager\Sectors\SectorRepository as BaseSectorRepository;

class SectorRepository extends BaseSectorRepository
{
    /**
     * @var Sector
     */
    protected $model;

    /**
     * @var SectorSchedule
     */
    private $schedule;

    /**
     * @param Sector         $model
     * @param SectorSchedule $schedule
     */
    function __construct(Sector $model, SectorSchedule $schedule)
    {
        $this->model = $model;
        $this->schedule = $schedule;
    }

    /**
     * @param $month
     * @return mixed
     */
    public function getSectorsDueForPaInMonth($month)
    {
        return $this->model->whereHas('schedule', function ($q) use ($month) {
            $q->where('month', $month);
        })->get();
    }

    /**
     * @param $id
     * @param $month
     * @return bool
     */
    public function saveScheduledMonth($id, $month)
    {
        return $this->model
            ->find($id)
            ->schedule()
            ->updateOrCreate(['sector_id' => $id], ['sector_id' => $id, 'month' => $month]);
    }

}