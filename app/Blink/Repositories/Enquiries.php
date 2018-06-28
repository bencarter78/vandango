<?php

namespace App\Blink\Repositories;

use App\Blink\Models\Enquiry;

class Enquiries extends BlinkRepository
{
    /**
     * @var Enquiry
     */
    protected $model;

    /**
     * Enquiries constructor.
     *
     * @param $model
     */
    public function __construct(Enquiry $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getLive($orderBy = 'updated_at', $sort = 'asc')
    {
        return $this->model
            ->with('applicants', 'campaign', 'contact', 'contact.organisation', 'opportunities', 'owners', 'statuses', 'vacancies', 'vacancies.hires')
            ->whereNull('deleted_at')
            ->orderBy($orderBy, $sort)
            ->get();
    }

    /**
     * @param      $id
     * @param null $withRelated
     * @return mixed
     */
    public function find($id, $withRelated = null)
    {
        $enquiry = $this->requireById($id, true);

        if ($withRelated) {
            $enquiry->load('contact', 'contact.organisation', 'contact.organisation.locations', 'owners');
        }

        return $enquiry;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    public function getUnassigned()
    {
        return $this->model->doesntHave('owners')->get();
    }
}