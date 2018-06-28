<?php

namespace App\Apply\Models;

use Carbon\Carbon;

class ContractYear
{
    /**
     * @var null|static
     */
    private $date;

    /**
     * @var
     */
    private $yearStart;

    /**
     * @var
     */
    private $yearEnd;

    /**
     * ContractYear constructor.
     *
     * @param null $date
     */
    public function __construct($date = null)
    {
        if (!$date) {
            $date = Carbon::today();
        }

        $this->date = $date;

        $this->setDateRange();
    }

    /**
     * @void
     */
    public function setDateRange()
    {
        $this->setYearStart(Carbon::parse("1st August " . $this->date->format('Y')));
        $this->setYearEnd($this->yearStart->copy()->addMonths(11)->endOfMonth());

        if (!$this->isInDateRange()) {
            $this->setYearStart($this->yearStart->subYear());
            $this->setYearEnd($this->yearStart->copy()->addMonths(11)->endOfMonth());
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function dateRange()
    {
        return collect([$this->yearStart, $this->yearEnd]);
    }

    /**
     * @return Collection|Array
     */
    public function periods()
    {
        return collect(range(2, 12))->map(function ($month) {
            return $this->period($month);
        })->prepend($this->period(1))->values();
    }

    /**
     * @return bool
     */
    private function isInDateRange()
    {
        return $this->date->between($this->yearStart, $this->yearEnd);
    }

    /**
     * @param $month
     * @return array
     */
    private function period($month)
    {
        return [
            'period' => $month,
            'start' => $this->yearStart->copy()->addMonths($month - 1)->startOfMonth(),
            'end' => $this->yearStart->copy()->addMonths($month - 1)->endOfMonth(),
        ];
    }

    /**
     * @param $date
     */
    private function setYearStart($date)
    {
        $this->yearStart = $date;
    }

    /**
     * @param $date
     */
    private function setYearEnd($date)
    {
        $this->yearEnd = $date;
    }

    /**
     * @return mixed
     */
    public function getYearStart()
    {
        return $this->yearStart;
    }

    /**
     * @return mixed
     */
    public function getYearEnd()
    {
        return $this->yearEnd;
    }
}