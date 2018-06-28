<?php
namespace App\Judi\Models;

use App\Core\BaseModel;

class SectorSchedule extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'judi_sector_schedule';

    /**
     * @var array
     */
    protected $fillable = ['sector_id', 'month'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

}