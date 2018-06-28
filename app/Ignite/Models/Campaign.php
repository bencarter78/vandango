<?php

namespace App\Ignite\Models;

use App\Blink\Models\Enquiry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'ignite_campaigns';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function enquiries()
    {
        return $this->hasMany(Enquiry::class, 'campaign_id')->withTrashed();
    }
}
