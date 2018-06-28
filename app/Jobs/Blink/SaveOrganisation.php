<?php

namespace App\Jobs\Blink;

use App\Blink\Repositories\Organisations;
use App\Events\Blink\OrganisationWasAdded;

class SaveOrganisation
{
    /**
     * @var array
     */
    private $data;

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
     * @param Organisations $organisations
     * @return mixed
     */
    public function handle(Organisations $organisations)
    {
        if ($this->hasId()) {
            return $this->update($organisations->requireById($this->data['organisation_id'], true));
        }

        if ($this->hasName()) {
            $organisation = $organisations->add($this->data());

            event(new OrganisationWasAdded($organisation));

            return $organisation;
        }
    }

    /**
     * @return bool
     */
    private function hasId()
    {
        return isset($this->data['organisation_id']) && ($this->data['organisation_id'] != '');
    }

    /**
     * @param $organisation
     * @return mixed
     */
    private function update($organisation)
    {
        $this->data['organisation_name'] = $organisation->name;
        $organisation->update($this->data());

        return $organisation;
    }

    /**
     * @return bool
     */
    private function hasName()
    {
        return isset($this->data['organisation_name']) && ($this->data['organisation_name'] != '');
    }

    /**
     * @return array
     */
    public function data()
    {
        return [
            'name' => $this->data['organisation_name'],
            'tel' => isset($this->data['organisation_tel']) ? $this->data['organisation_tel'] : null,
            'email' => isset($this->data['organisation_email']) ? $this->data['organisation_email'] : null,
            'website' => isset($this->data['organisation_website']) ? $this->data['organisation_website'] : null,
            'twitter' => isset($this->data['organisation_twitter']) ? $this->data['organisation_twitter'] : null,
            'datastore_ref' => isset($this->data['datastore_ref']) ? $this->data['datastore_ref'] : null,
            'site_count' => isset($this->data['site_count']) ? $this->data['site_count'] : null,
            'legal_status' => isset($this->data['legal_status']) ? $this->data['legal_status'] : null,
            'hq_id' => isset($this->data['hq_id']) ? $this->data['hq_id'] : null,
        ];
    }
}
