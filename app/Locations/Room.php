<?php

namespace App\Locations;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * @var string
     */
    protected $table = 'locations_rooms';

    /**
     * @var array
     */
    protected $fillable = ['centre_id', 'name', 'capacity'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function centre()
    {
        return $this->belongsTo(Centre::class);
    }
}
