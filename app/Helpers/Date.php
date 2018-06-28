<?php

use Carbon\Carbon;

if ( ! function_exists('createCarbonObject')) {
    /**
     * Creates a carbon object
     *
     * @param $dateFormat
     * @param $date
     * @return mixed
     */
    function createCarbonObject($dateFormat, $date)
    {
        return Carbon::createFromFormat($dateFormat, $date);
    }
}

if ( ! function_exists('getMonths')) {
    /**
     * Returns an array of the calendar months
     *
     * @return mixed
     */
    function getMonths()
    {
        $date = Carbon::createFromFormat('m', '1');
        $months[1] = $date->startOfMonth()->format('F');

        foreach (range(2, 12) as $month) {
            $months[$month] = $date->addMonth()->format('F');
        }

        return $months;
    }
}

function getCarbonDate($date = null)
{
    // yyyy-mm-dd
    if (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $date)) {
        return Carbon::createFromFormat('Y-m-d', $date);
    }

    // dd/mm/yyyy
    if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $date)) {
        return Carbon::createFromFormat('d/m/Y', $date);
    }
}

function getHours()
{
    $time = Carbon::now()->startOfDay();
    $hours[$time->format('H')] = $time->format('H');

    foreach (range(1, 23) as $i) {
        $h = $time->addHour()->format('H');
        $hours[$h] = $h;
    }

    return $hours;
}

function getMinutes($interval = 1)
{
    $minutes = ['00' => '00'];
    $time = Carbon::now()->startOfDay();

    for ($i = 0; $i <= 59; $i += $interval) {
        $min = $time->addMinutes($interval)->format('i');
        $minutes[$min] = $min;
    }

    return $minutes;
}

function getTimeByInterval($interval = 1, $start = 8, $end = 22)
{
    $start = Carbon::now()->startOfDay()->addHours($start);
    $time = $start->copy();

    $minutes = [$time->format('H:i') => $time->format('H:i')];

    while ($time < $start->startOfDay()->addHours($end)) {
        $min = $time->addMinutes($interval)->format('H:i');
        $minutes[$min] = $min;
    }

    return $minutes;
}

if ( ! function_exists('currentContractYear')) {
    function currentContractYear()
    {
        $start = Carbon::parse('1st August');

        if ($start->format('Y') === date('Y') && $start > date('Y-m-d')) {
            $start->subYear();
        }

        return collect([$start, $start->copy()->subDay()->endOfDay()->addYear()]);
    }
}

if ( ! function_exists('contractYearPeriods')) {
    function contractYearPeriods()
    {
        $period = currentContractYear()->first();

        for ($i = 0; $i < 12; $i++) {
            $periods[$i + 1] = [
                'start' => $period->startOfMonth()->format('Y-m-d'),
                'end' => $period->endOfMonth()->format('Y-m-d'),
            ];
            $period->startOfMonth()->addMonth();
        }

        return collect($periods);
    }
}

if ( ! function_exists('periodFromDate')) {
    function periodFromDate($date)
    {
        return contractYearPeriods()->filter(function ($p, $key) use ($date) {
            if ($date->format('Y-m-d') >= $p['start'] && $date->format('Y-m-d') <= $p['end']) {
                return $key;
            }
        })->keys()->first();
    }
}