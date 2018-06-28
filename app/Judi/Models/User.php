<?php

namespace App\Judi\Models;

use App\UserManager\Users\User as BaseUser;

class User extends BaseUser
{
    /**
     * Determines which PAs are linked to which processes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function processes()
    {
        return $this->belongsToMany(Process::class, 'judi_process_user', 'user_id', 'process_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function caseload()
    {
        return $this->hasMany(Assessment::class, 'assessor_id');
    }

    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sectors()
    {
        return $this->belongsToMany(Sector::class, 'users_sectors');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function assessmentSettings()
    {
        return $this->hasOne(UserAssessmentSetting::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function assessedProcesses()
    {
        return $this->roles->flatMap->processes;
    }

    /**
     * @return bool
     */
    public function isPa()
    {
        return $this->hasRole(config('vandango.judi.roles.pa'));
    }
}