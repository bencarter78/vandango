<?php

namespace App\Classroom\Models;

use App\UserManager\Users\User as BaseUser;

class User extends BaseUser
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function timetable()
    {
        return $this->morphToMany(Timetable::class, 'attendee', 'classroom_cohorts')->withPivot('id', 'attended', 'cost');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function agreements()
    {
        return $this->hasMany(LearningAgreement::class)->withTrashed();
    }
}
