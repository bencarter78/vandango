<?php

namespace App\Classroom\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseType extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'classroom_course_types';
}
