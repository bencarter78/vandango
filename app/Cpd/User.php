<?php

namespace App\Cpd;

use App\UserManager\Users\User as BaseUser;

class User extends BaseUser
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cv()
    {
        return $this->hasOne(Cv::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
