<?php

namespace App\Classroom\Models;

use App\UserManager\Users\Guest as BaseGuest;

class Guest extends BaseGuest
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function timetable()
    {
        return $this->morphToMany(Timetable::class, 'attendee', 'classroom_cohorts');
    }
}
