<?php

namespace App\Blink\Models;

use Illuminate\Database\Eloquent\Model;

class Rejection extends Model
{
    /**
     * @var string
     */
    protected $table = 'blink_rejections';

    /**
     * @var array
     */
    protected $fillable = ['vacancy_id', 'rejection_type_id', 'rejected_by', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function by()
    {
        return $this->belongsTo(User::class, 'rejected_by')->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rejectionType()
    {
        return $this->belongsTo(Rejection::class);
    }
}
