<?php

namespace App\Eportfolios\Models;

use App\Apply\Models\Sector;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Centre extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'eportfolios_centres';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sectors()
    {
        return $this->belongsToMany(Sector::class, 'eportfolio_centre_sector');
    }
}
