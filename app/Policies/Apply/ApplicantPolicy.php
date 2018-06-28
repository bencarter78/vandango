<?php

namespace App\Policies\Apply;

use App\UserManager\Users\User;
use App\Apply\Models\Applicant;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the applicant.
     *
     * @param  \App\UserManager\Users\User $user
     * @param  \App\Apply\Models\Applicant $applicant
     * @return mixed
     */
    public function view(User $user, Applicant $applicant)
    {
        //
    }

    /**
     * Determine whether the user can create applicants.
     *
     * @param  \App\UserManager\Users\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the applicant.
     *
     * @param  \App\UserManager\Users\User $user
     * @param  \App\Apply\Models\Applicant $applicant
     * @return mixed
     */
    public function update(User $user, Applicant $applicant)
    {
        return $user->hasAccess('applyAdmin')
            || $user->isManagerOf($applicant->adviser_id)
            || $user->id == $applicant->adviser_id;
    }

    /**
     * Determine whether the user can delete the applicant.
     *
     * @param  \App\UserManager\Users\User $user
     * @param  \App\Apply\Models\Applicant $applicant
     * @return mixed
     */
    public function delete(User $user, Applicant $applicant)
    {
        //
    }

    /**
     * Determine whether the user can assign an adviser to the applicant
     *
     * @param User      $user
     * @param Applicant $applicant
     * @return bool
     */
    public function assignAdviser(User $user, Applicant $applicant)
    {
        return $user->hasAccess('applyAdmin') || in_array($applicant->sector_id, $user->sectors()->pluck('id')->all());
    }
}
