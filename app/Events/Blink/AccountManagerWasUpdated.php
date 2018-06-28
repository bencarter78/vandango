<?php

namespace App\Events\Blink;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class AccountManagerWasUpdated
{
    use Dispatchable, SerializesModels;

    /**
     * @var
     */
    public $user;

    /**
     * @var
     */
    public $enquiry;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @param $enquiry
     */
    public function __construct($user, $enquiry)
    {
        $this->user = $user;
        $this->enquiry = $enquiry;
    }
}
