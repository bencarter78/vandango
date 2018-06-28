<?php

namespace App\Events\Blink;

use App\Blink\Models\Vacancy;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class ApplicationManagerWasAssigned
{
    use Dispatchable, SerializesModels;

    /**
     * @var Vacancy
     */
    public $vacancy;

    /**
     * Create a new event instance.
     *
     * @param Vacancy $vacancy
     */
    public function __construct(Vacancy $vacancy)
    {
        $this->vacancy = $vacancy;
    }
}
