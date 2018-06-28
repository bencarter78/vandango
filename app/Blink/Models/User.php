<?php

namespace App\Blink\Models;

use App\UserManager\Users\User as BaseUser;

class User extends BaseUser
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function enquiries()
    {
        return $this->BelongsToMany(Enquiry::class, 'blink_enquiry_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function opportunities()
    {
        return $this->BelongsToMany(Opportunity::class);
    }

    /**
     * @param $sectorName
     * @return bool
     */
    public function canApproveVacancy($sectorName)
    {
        return $this->hasAccess('blinkAdmin') ||
            ($this->hasSector($sectorName) && $this->hasRole(config('vandango.blink.roles.approver')));
    }
}
