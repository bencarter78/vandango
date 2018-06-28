<?php

namespace App\Policies\Blink;

use App\Blink\Models\Vacancy;
use App\UserManager\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class VacancyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the vacancy.
     *
     * @param User                       $user
     * @param  \App\Blink\Models\Vacancy $vacancy
     * @return mixed
     */
    public function view(User $user, Vacancy $vacancy)
    {
        //
    }

    /**
     * Determine whether the user can create vacancies.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the vacancy.
     *
     * @param User                       $user
     * @param  \App\Blink\Models\Vacancy $vacancy
     * @return mixed
     */
    public function update(User $user, Vacancy $vacancy)
    {
        return $user->hasAccess('blinkAdmin')
            || $user->isSectorManager($vacancy->sector->name)
            || $user->id == $vacancy->sector->department->manager_id
            || ($user->hasSector($vacancy->sector->name)
                && $user->hasRole(config('vandango.blink.roles.approver')));
    }

    /**
     * Determine whether the user can delete the vacancy.
     *
     * @param User                       $user
     * @param  \App\Blink\Models\Vacancy $vacancy
     * @return mixed
     */
    public function delete(User $user, Vacancy $vacancy)
    {
        return $user->hasAccess('blinkAdmin')
            || $user->id == $vacancy->submitted_by
            || $user->id == $vacancy->enquiry->owners->last()->id;
    }
}
