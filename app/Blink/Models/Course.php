<?php

namespace App\Blink\Models;

use App\Blink\AwardingBody;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * @var string
     */
    protected $table = 'blink_courses';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $dates = ['framework_expires_on'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function awardingBody()
    {
        return $this->belongsTo(AwardingBody::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}
