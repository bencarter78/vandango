<?php

namespace App\Blink\Summary;

class DepartmentSummary extends Summary
{
    /**
     * @param $enquiry
     * @param $model
     * @return bool
     */
    protected function isMatch($enquiry, $model)
    {
        return $model->id == $enquiry->owners->last()->departments->first()->id;
    }
}