<?php

namespace App\Blink\Summary;

class UserSummary extends Summary
{
    /**
     * @param $enquiry
     * @param $model
     * @return bool
     */
    protected function isMatch($enquiry, $model)
    {
        return $model->id == $enquiry->owners->last()->id;
    }
}