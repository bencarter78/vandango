<?php

namespace App\Jobs\Blink;

use Tck\HumanNameParser\Parser;
use App\Blink\Repositories\Contacts;
use App\Events\Blink\ContactWasAdded;

class SaveContact
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var
     */
    private $contact;

    /**
     * @var
     */
    private $contactName;

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
     * @param Contacts $contacts
     * @param Parser   $parser
     * @return mixed
     */
    public function handle(Contacts $contacts, Parser $parser)
    {
        $this->parseName($parser);

        if ($this->hasId()) {
            $this->contact = $contacts->requireById($this->data['contact_id']);
            $this->contact->update($this->data());
        } else {
            $this->contact = $contacts->add($this->data());
        }

        event(new ContactWasAdded($this->contact));

        return $this->contact;
    }

    /**
     * @param Parser $parser
     * @return array
     */
    private function parseName(Parser $parser)
    {
        if ($this->hasName()) {
            $parser->setString($this->data['contact_name']);
            $this->contactName = $parser;
        }
    }

    /**
     * @return bool
     */
    private function hasName()
    {
        return isset($this->data['contact_name']) && $this->data['contact_name'] != '';
    }

    /**
     * @return bool
     */
    private function hasId()
    {
        return isset($this->data['contact_id']) && $this->data['contact_id'] != '';
    }

    /**
     * @return array
     */
    public function data()
    {
        return [
            'organisation_id' => $this->getOrganisationId(),
            'first_name' => $this->contactName ? $this->contactName->firstName() : null,
            'surname' => $this->contactName ? $this->contactName->surname() : null,
            'tel' => isset($this->data['contact_tel']) ? $this->data['contact_tel'] : '',
            'email' => isset($this->data['contact_email']) ? $this->data['contact_email'] : '',
        ];
    }

    /**
     * @return null
     */
    private function getOrganisationId()
    {
        if ( ! isset($this->data['organisation']) && ($this->contact && $this->contact->organisation_id)) {
            $this->data['organisation'] = $this->contact->organisation;
        }

        return isset($this->data['organisation']) ? $this->data['organisation']->id : null;
    }
}
