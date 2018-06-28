<?php

namespace App\Policies\Blink;

use App\UserManager\Users\User;
use App\Blink\Models\Course;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the course.
     *
     * @param  \App\UserManager\Users\User $user
     * @param  \App\Blink\Models\Course    $course
     * @return mixed
     */
    public function view(User $user, Course $course)
    {
        //
    }

    /**
     * Determine whether the user can create courses.
     *
     * @param  \App\UserManager\Users\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess('blinkAdmin') || $user->isDepartmentManager();
    }

    /**
     * Determine whether the user can create courses.
     *
     * @param  \App\UserManager\Users\User $user
     * @return mixed
     */
    public function edit(User $user)
    {
        return $user->hasAccess('blinkAdmin') || $user->isDepartmentManager();
    }

    /**
     * Determine whether the user can update the course.
     *
     * @param  \App\UserManager\Users\User  $user
     * @param  \App\Blink\Models\Course $course
     * @return mixed
     */
    public function update(User $user, Course $course)
    {
        //
    }

    /**
     * Determine whether the user can delete the course.
     *
     * @param  \App\UserManager\Users\User  $user
     * @param  \App\Blink\Models\Course $course
     * @return mixed
     */
    public function delete(User $user, Course $course)
    {
        //
    }
}
