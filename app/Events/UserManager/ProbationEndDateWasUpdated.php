<?php

namespace App\Events\UserManager;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class ProbationEndDateWasUpdated extends Event
{
    use SerializesModels;

    /**
     * @var
     */
    public $user;

    /**
     * @var
     */
    public $originalEndDate;

    /**
     * @var
     */
    public $newEndDate;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @param $originalEndDate
     * @param $newEndDate
     */
    public function __construct($user, $originalEndDate, $newEndDate)
    {
        $this->user = $user;
        $this->originalEndDate = $originalEndDate;
        $this->newEndDate = $newEndDate;
    }

}
