<?php

namespace App\Classroom\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LearningAgreement extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'classroom_learning_agreements';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'timetable_id', 'is_signed'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function timetable()
    {
        return $this->belongsTo(Timetable::class);
    }
}
