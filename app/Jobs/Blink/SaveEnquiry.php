<?php

namespace App\Jobs\Blink;

use App\Blink\Models\Contact;
use App\Blink\Repositories\Enquiries;
use App\Exceptions\EnquiryHasNoContactException;

class SaveEnquiry
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var
     */
    private $repository;

    /**
     * @var
     */
    private $enquiry;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @param Enquiries $repository
     * @return Enquiry
     * @throws EnquiryHasNoContactException
     */
    public function handle(Enquiries $repository)
    {
        $this->repository = $repository;
        $this->isExistingEnquiry() ? $this->update() : $this->add();
        $this->attachRelationFrom('user_id', 'owners');
        $this->attachRelationFrom('status_id', 'statuses');

        return $this->enquiry;
    }

    /**
     * @return bool
     */
    private function isExistingEnquiry()
    {
        return $this->dataContains('enquiry_id');
    }

    /**
     * @param $key
     * @return bool
     */
    private function dataContains($key)
    {
        return isset($this->data[$key]) && $this->data[$key] != '';
    }

    /**
     * @return void
     */
    private function update()
    {
        $this->enquiry = $this->repository->requireById($this->data['enquiry_id']);

        $this->enquiry->update($this->data());
    }

    /**
     * @return array
     */
    private function data()
    {
        return [
            'contact_id' => $this->data['contact']->id,
            'location' => $this->data['location'],
            'referrer_id' => $this->data['referrer_id'],
            'employee_count' => isset($this->data['organisation_size']) ? $this->data['organisation_size'] : null,
        ];
    }

    /**
     * @return bool
     * @throws EnquiryHasNoContactException
     */
    private function hasContact()
    {
        if (isset($this->data['contact']) && $this->data['contact'] instanceof Contact) {
            return true;
        }
        throw new EnquiryHasNoContactException('Please assign a contact to the enquiry before it is created.');
    }

    /**
     * @return void
     * @throws EnquiryHasNoContactException
     */
    private function add()
    {
        if ($this->hasContact()) {
            $this->enquiry = $this->repository->add($this->data());
        }
    }

    /**
     * @param $key
     * @param $relationship
     */
    private function attachRelationFrom($key, $relationship)
    {
        if ($this->dataContains($key)) {
            $this->enquiry
                ->{$relationship}()
                ->attach([$this->data[$key]], ['updated_by' => $this->data['updated_by']]);
        }
    }
}
