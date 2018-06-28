<?php

namespace App\Listeners\Judi;

use App\Jobs\Judi\PlanAssessments;
use App\Judi\Repositories\UserRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Events\UserManager\UserMembershipsWereUpdated;

class CheckUserHasRequiredAssessments
{
    use DispatchesJobs;

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * Create the event handler.
     *
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Handle the event.
     *
     * @param  UserMembershipsWereUpdated $event
     * @return void
     */
    public function handle(UserMembershipsWereUpdated $event)
    {
        $user = $this->users->requireById($event->getUser()->id);
        $user->sectors->each(function ($sector) use ($user) {
            $this->dispatch(new PlanAssessments($user, $sector));
        });
    }
}
