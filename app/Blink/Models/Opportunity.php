<?php

namespace App\Blink\Models;

use App\Apply\Models\Sector;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opportunity extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'blink_opportunities';

    /**
     * @var array
     */
    protected $fillable = ['enquiry_id', 'user_id', 'sector_id', 'quantity', 'value', 'expected_on', 'programme_type'];

    /**
     * @var array
     */
    protected $dates = ['expected_on'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsToMany(User::class, 'blink_opportunity_user')->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    /**
     * @return string
     */
    public function getFormattedValueAttribute()
    {
        return '£' . number_format($this->attributes['value']);
    }
}
