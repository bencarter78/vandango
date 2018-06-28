<?php

namespace App\Judi\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends BaseModel
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'judi_reports';

    /**
     * @var array
     */
    protected $fillable = ['title', 'description'];

    /**
     * @return $this
     */
    public function criteria()
    {
        return $this->belongsToMany(Criteria::class, 'judi_criteria_report')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function summary()
    {
        return $this->belongsToMany(Summary::class, 'judi_summaries');
    }
}