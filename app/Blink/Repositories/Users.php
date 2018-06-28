<?php

namespace App\Blink\Repositories;

use App\Blink\Models\User;

class Users extends BlinkRepository
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
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param        $userId
     * @param string $orderBy
     * @return mixed
     */
    public function getLiveEnquiries($userId, $orderBy = 'updated_at')
    {
        return $this->model
            ->with('enquiries', 'enquiries.applicants', 'enquiries.campaign', 'enquiries.contact', 'enquiries.contact.organisation', 'enquiries.opportunities', 'enquiries.statuses', 'enquiries.vacancies')
            ->whereNull('deleted_at')
            ->find($userId)
            ->enquiries
            ->map(function ($enquiry) use ($userId) {
                if ($enquiry->owners->last()->id == $userId) {
                    return $enquiry;
                }
            })
            ->reject(function ($enquiry) {
                return $enquiry === null;
            })
            ->unique()
            ->sortByDesc($orderBy)
            ->values();
    }
}