<?php

namespace App\Judi\Models;

use Illuminate\Database\Eloquent\Model;

class UserAssessmentSetting extends Model
{
    /**
     * @var string
     */
    protected $table = 'judi_user_assessment_settings';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'settings'];
}
