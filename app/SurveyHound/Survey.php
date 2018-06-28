<?php

namespace App\SurveyHound;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
    use SoftDeletes;
    
    /**
     * @var string
     */
    protected $table = 'surveyhound_surveys';

    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'sql', 'subject', 'message', 'frequency'];
}
