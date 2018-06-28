<?php

namespace App\Jobs\Blink;

use Carbon\Carbon;
use App\Blink\Models\Status;
use InvalidArgumentException;
use App\Blink\Repositories\Vacancies;
use App\Events\Blink\VacancyWasReceived;
use App\Events\Blink\ApplicationManagerWasAssigned;

class SaveVacancy
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var null
     */
    private $vacancy;

    /**
     * Create a new job instance.
     *
     * @param array $data
     * @param null  $vacancy
     */
    public function __construct(array $data = [], $vacancy = null)
    {
        $this->data = $data;
        $this->vacancy = $vacancy;
        $this->statuses = [
            'draft' => config('vandango.blink.statuses.vacancy-saved'),
            'pending' => config('vandango.blink.statuses.vacancy-pending'),
            'unqualified' => config('vandango.blink.statuses.unqualified'),
        ];
    }

    /**
     * Execute the job.
     *
     * @param Vacancies $vacancies
     * @return void
     */
    public function handle(Vacancies $vacancies)
    {
        $vacancy = isset($this->vacancy)
            ? $this->vacancy
            : $vacancies->getNew();

        return tap($vacancy, function ($vacancy) {
            $vacancy->fill($this->vacancyData())->save();

            if ($this->isBeingSubmit()) {
                return $this->submit($vacancy);
            }

            return $this->setStatus($vacancy, $this->statuses['draft']);
        });
    }

    /**
     * @return array
     */
    private function vacancyData()
    {
        return [
            'enquiry_id' => $this->data['enquiry_id'],
            'contact_id' => $this->data['contact_id'],
            'location_id' => isset($this->data['location_id']) ? $this->data['location_id'] : null,
            'application_manager_id' => $this->data['application_manager_id'],
            'submitted_by' => $this->data['submitted_by'],
            'title' => $this->data['title'],
            'framework_id' => $this->data['framework_id'],
            'qual_type' => $this->data['qual_type'],
            'level_id' => $this->data['level_id'],
            'duration' => $this->data['duration'],
            'wage' => $this->data['wage'],
            'sector_id' => $this->data['sector_id'],
            'hours' => $this->data['hours'],
            'working_week' => $this->data['working_week'],
            'closes_on' => $this->parseDate($this->data['closes_on']),
            'interviews_on' => $this->parseDate($this->data['interviews_on']),
            'starts_on' => $this->parseDate($this->data['starts_on']),
            'positions_count' => $this->data['positions_count'],
            'description' => $this->data['description'],
            'required_skills' => $this->data['required_skills'],
            'required_qualifications' => $this->data['required_qualifications'],
            'personal_qualities' => $this->data['personal_qualities'],
            'training_provided' => $this->data['training_provided'],
            'future_prospects' => $this->data['future_prospects'],
            'filter_applications' => $this->data['filter_applications'],
            'considerations' => $this->data['considerations'],
            'question_1' => $this->data['question_1'],
            'question_2' => $this->data['question_2'],
            'is_visible' => $this->data['is_visible'],
            'application_route_url' => $this->data['application_route_url'],
            'organisation_description' => $this->data['organisation_description'],
        ];
    }

    /**
     * @return bool
     */
    private function isBeingSubmit()
    {
        return isset($this->data['submit']);
    }

    /**
     * @param $vacancy
     */
    private function submit($vacancy)
    {
        $this->markAsApprovalPending($vacancy);
        event(new ApplicationManagerWasAssigned($vacancy));
        event(new VacancyWasReceived($vacancy));
        $this->progressUnqualifiedEnquiry($vacancy->enquiry);
        $this->addActivity($vacancy);
    }

    /**
     * @param $vacancy
     */
    private function markAsApprovalPending($vacancy)
    {
        $vacancy->update(['approved_by' => null]);
        $this->setStatus($vacancy, $this->statuses['pending']);
    }

    /**
     * @param $enquiry
     */
    private function progressUnqualifiedEnquiry($enquiry)
    {
        if ($enquiry->hasStatus($this->statuses['unqualified'])) {
            dispatch(new ProgressEntity($enquiry, $this->data['submitted_by']));
        }
    }

    /**
     * @param $vacancy
     */
    private function addActivity($vacancy)
    {
        dispatch(new SaveActivity($vacancy->enquiry, [
            'due_at' => Carbon::now()->format('d/m/Y'),
            'note' => $vacancy->title . ' vacancy was submitted for approval.',
            'updated_by' => $this->data['submitted_by'],
        ]));
    }

    /**
     * @param $vacancy
     * @param $name
     */
    private function setStatus($vacancy, $name)
    {
        $status = Status::whereName($name)->first();
        if ($vacancy->statuses->count() === 0 || $vacancy->statuses->last()->id != $status->id) {
            $vacancy->statuses()->attach($status->id, ['updated_by' => $this->data['submitted_by']]);
        }
    }

    /**
     * @param $date
     * @return null|static
     */
    private function parseDate($date)
    {
        try {
            return isset($date) ? Carbon::createFromFormat('d/m/Y', $date) : null;
        } catch (InvalidArgumentException $e) {
            return isset($date) ? Carbon::createFromFormat('Y-m-d H:i:s', $date) : null;
        }
    }
}
