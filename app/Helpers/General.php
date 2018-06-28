<?php

if ( ! function_exists('getCronJobFrequencies')) {
    function getCronJobFrequencies()
    {
        return [
            'minute' => 'Minute',
            'hour' => 'Hour',
            'day' => 'Day',
            'week' => 'Week',
            'month' => 'Month',
            'year' => 'Year',
        ];
    }
}

if ( ! function_exists('loadPackageNav')) {
    function loadPackageNav($package = null)
    {
        if (Request::segment(1) == null) {
            return 'partials.nav._app';
        }

        if ($package == null) {
            $package = Request::segment(1);

            return $package . '.partials._nav';
        }

        return $package . '.partials._nav';
    }
}