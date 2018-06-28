<?php

namespace App\Classroom\Models;

use App\UserManager\Roles\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'classroom_courses';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'course_type_id', 'is_mandatory', 'is_agreement_required', 'cost', 'resource_url', 'aim_ref'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'classroom_courses_roles', 'role_id', 'course_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(CourseType::class, 'course_type_id');
    }
}
