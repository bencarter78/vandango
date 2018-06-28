<?php

namespace App\Jobs\Blink;

use Carbon\Carbon;
use App\Blink\Models\Status;
use App\Blink\Models\Vacancy;
use Illuminate\Contracts\Auth\Guard;
use App\Events\Blink\VacancyWasApproved;
use App\Events\Blink\VacancyWasRejected;

class ProcessVacancyApprovalDecision
{
    /**
     * @var
     */
    private $data;

    /**
     * @var Vacancy
     */
    private $vacancy;

    /**
     * Create a new job instance.
     *
     * @param         $data
     * @param Vacancy $vacancy
     */
    public function __construct(array $data, Vacancy $vacancy)
    {
        $this->data = $data;
        $this->vacancy = $vacancy;
    }

    /**
     * Execute the job.
     *
     * @param Guard  $auth
     * @param Status $status
     * @return void
     */
    public function handle(Guard $auth, Status $status)
    {
        $user = $auth->user();

        if (isset($this->data['approve'])) {
            $statusName = config('vandango.blink.statuses.vacancy-approved');
            $this->markApproved($user);
            event(new VacancyWasApproved($this->vacancy));
            dispatch(new SaveActivity($this->vacancy->enquiry, [
                'due_at' => Carbon::now()->format('d/m/Y'),
                'note' => $this->vacancy->title . ' vacancy was approved.',
                'updated_by' => $user->id,
            ]));
        } else {
            $statusName = config('vandango.blink.statuses.vacancy-rejected');
            $this->markRejected($user);
            event(new VacancyWasRejected($this->vacancy));
            dispatch(new SaveActivity($this->vacancy->enquiry, [
                'due_at' => Carbon::now()->format('d/m/Y'),
                'note' => $this->vacancy->title . ' vacancy was rejected. "' . $this->data['reason'] . '"',
                'updated_by' => $user->id,
            ]));
            $this->vacancy->delete();
        }

        $this->addStatus($status->whereName($statusName)->first(), $user);
    }

    /**
     * @param $user
     */
    private function markApproved($user)
    {
        $this->vacancy->update(['approved_by' => $user->id]);
    }

    /**
     * @param $user
     */
    private function markRejected($user)
    {
        $this->vacancy->rejected()->create([
            'vacancy_id' => $this->vacancy->id,
            'description' => $this->data['reason'],
            'rejected_by' => $user->id,
        ]);
    }

    /**
     * @param $status
     * @param $user
     * @return mixed
     */
    private function addStatus($status, $user)
    {
        $now = Carbon::now();

        $this->vacancy
            ->statuses()
            ->attach($status->id, [
                'updated_by' => $user->id,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
    }
}
