<?php

namespace App\Events\Blink;

use Illuminate\Queue\SerializesModels;

class ContactWasAdded
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
