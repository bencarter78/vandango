<?php

namespace App\RoomMate\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * @var string
     */
    protected $table = 'roommate_rooms';

    /**
     * @var array
     */
    protected $fillable = ['site_id', 'name', 'capacity'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
