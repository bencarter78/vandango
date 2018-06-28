<?php

namespace App\Apply\Models;

use App\Eportfolios\Models\Centre;
use App\UserManager\Sectors\Sector as BaseSector;

class Sector extends BaseSector
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function eportfolioCentres()
    {
        return $this->belongsToMany(Centre::class, 'eportfolio_centre_sector');
    }

    /**
     * @param $centres
     */
    public function syncCentres($centres)
    {
        return $this->eportfolioCentres()->sync($centres);
    }
}
