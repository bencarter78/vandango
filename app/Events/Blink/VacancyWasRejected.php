<?php

namespace App\Events\Blink;

use App\Blink\Models\Vacancy;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class VacancyWasRejected
{
    use Dispatchable, SerializesModels;

    /**
     * @var
     */
    public $vacancy;

    /**
     * Create a new event instance.
     *
     * @param $vacancy
     */
    public function __construct(Vacancy $vacancy)
    {
        $this->vacancy = $vacancy;
    }
}
