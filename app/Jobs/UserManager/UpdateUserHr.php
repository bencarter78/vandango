<?php

namespace App\Jobs\UserManager;

use App\Jobs\Job;
use Carbon\Carbon;
use App\UserManager\Users\User;
use App\Http\Requests\UserManager\StoreUserRequest;
use App\Events\UserManager\ProbationEndDateWasUpdated;

class UpdateUserHr extends Job
{
    /**
     * @var StoreUserRequest
     */
    private $request;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @param StoreUserRequest $request
     * @param User             $user
     */
    public function __construct(StoreUserRequest $request, User $user)
    {
        $this->request = $request;
        $this->user = $user;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->request->has('start_date')) {
            $this->user->meta->start_date = Carbon::createFromFormat('d/m/Y', $this->request->get('start_date'))->format('Y-m-d');
        }

        if ($this->request->has('probation_end_date')) {
            $this->user->meta->probation_end_date = Carbon::createFromFormat('d/m/Y', $this->request->get('probation_end_date'))->format('Y-m-d');
        } else {
            $this->user->meta->probation_end_date = null;
        }

        if ($this->request->has('appraisal_date')) {
            $this->user->meta->appraisal_date = Carbon::createFromFormat('d/m/Y', $this->request->get('appraisal_date'))->format('Y-m-d');
        } else {
            $this->user->meta->appraisal_date = null;
        }

        if ($this->user->meta->isDirty('probation_end_date')) {
            $hasUpdatedProbationDate = [
                'user' => $this->user,
                'original_end_date' => $this->user->meta->getOriginal('probation_end_date'),
                'updated_end_date' => $this->user->meta->probation_end_date,
            ];
        }

        $this->user->meta->save();

        if (isset($hasUpdatedProbationDate)) {
            event(new ProbationEndDateWasUpdated(
                $hasUpdatedProbationDate['user'],
                $hasUpdatedProbationDate['original_end_date'],
                $hasUpdatedProbationDate['updated_end_date']
            ));
        }

        return $this->user;
    }

}
