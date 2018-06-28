<?php

namespace App\Pics;

use App\UserManager\Sectors\Sector;
use Illuminate\Database\Eloquent\Model;

class QualificationPlan extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $appends = ['title'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id')->withTrashed();
    }

    /**
     * @return string
     */
    public function getTitleAttribute()
    {
        return "[{$this->sector->code}] $this->description";
    }
}
