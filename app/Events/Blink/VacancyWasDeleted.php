<?php

namespace App\Events\Blink;

use App\Blink\Models\Vacancy;

class VacancyWasDeleted
{
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
