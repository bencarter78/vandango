<?php

namespace App\Blink\Repositories;

use App\Blink\Models\Vacancy;
use Carbon\Carbon;

class Vacancies extends BlinkRepository
{
    /**
     * @var Vacancy
     */
    protected $model;

    /**
     * Vacancies constructor.
     *
     * @param Vacancy $model
     */
    public function __construct(Vacancy $model)
    {
        $this->model = $model;
    }

    /**
     * @param $statusId
     * @return static
     */
    public function submittedByStatus($statusId)
    {
        return $this->model
            ->whereNotNull('ref')
            ->get()
            ->filter(function ($v) use ($statusId) {
                return $v->statuses->last()->id === $statusId;
            });
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getClosed()
    {
        return $this->model->where('closes_on', '<', Carbon::today())->get();
    }
}