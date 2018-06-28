<?php

namespace App\Judi\Presenters;

use Laracasts\Presenter\Presenter;

class AssessmentPresenter extends Presenter
{
    /**
     * Calculates the timeliness of an assessment
     *
     * @return string
     */
    public function timeliness()
    {
        if ($this->deleted_at) {
            $diff = $this->assessment_date->diffInDays($this->deleted_at, false);
            $prefix = $diff <= 0 ? '' : '+';
            $class = $diff <= 0 ? 'success' : 'error';

            return "<small class='text-{$class}'>({$prefix}$diff)</small>";
        }
    }

}