<?php

namespace App\RoomMate\Models;

use App\Locations\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'tel', 'is_owned', 'has_disabled_access', 'parking', 'opens_at', 'closes_at',
    ];

    /**
     * @var array
     */
    protected $dates = ['opens_at', 'closes_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function location()
    {
        return $this->morphOne(Location::class, 'owner');
    }

}
