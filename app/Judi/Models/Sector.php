<?php

namespace App\Judi\Models;

use Carbon\Carbon;
use App\UserManager\Sectors\Sector as BaseSectorModel;

class Sector extends BaseSectorModel
{
    /**
     * @var string
     */
    protected $table = 'data_sectors';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function schedule()
    {
        return $this->hasOne(SectorSchedule::class, 'sector_id');
    }

    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_sectors');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    /**
     * @return bool
     */
    public function hasPaDue()
    {
        if ( ! $this->schedule) {
            return false;
        }

        $due = Carbon::createFromFormat('n', $this->schedule->month)->startOfMonth();
        $now = Carbon::now();

        if ($due < $now) {
            $due->addYear();
        }

        return $due->diffInMonths($now) <= config('vandango.judi.assessments.leadTime');
    }

}