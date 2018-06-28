<?php

namespace App\Jobs\Blink;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SaveActivity
{
    /**
     * @var Model
     */
    private $owner;

    /**
     * @var array
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @param       $owner
     * @param array $data
     */
    public function __construct($owner, array $data)
    {
        $this->owner = $owner;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->hasNote()) {
            return $this->owner->activities()->create([
                'assigned_by' => isset($this->data['assigned_by']) ? $this->data['assigned_by'] : null,
                'assigned_to' => isset($this->data['assigned_to']) ? $this->data['assigned_to'] : null,
                'due_at' => isset($this->data['due_at']) ? Carbon::createFromFormat("d/m/Y", $this->data['due_at']) : Carbon::now(),
                'note' => $this->data['note'],
                'updated_by' => isset($this->data['updated_by']) ? $this->data['updated_by'] : null,
            ]);
        }
    }

    /**
     * @return bool
     */
    private function hasNote()
    {
        return isset($this->data['note']) && $this->data['note'] != '';
    }
}
