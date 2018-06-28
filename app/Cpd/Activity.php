<?php

namespace App\Cpd;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'cpd_activities';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deliverer()
    {
        return $this->belongsTo(Organisation::class);
    }
}
