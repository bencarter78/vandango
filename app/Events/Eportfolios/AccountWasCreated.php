<?php

namespace App\Events\Eportfolios;

use App\Eportfolios\Models\Eportfolio;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class AccountWasCreated
{
    use Dispatchable, SerializesModels;

    /**
     * @var Eportfolio
     */
    public $eportfolio;

    /**
     * Create a new event instance.
     *
     * @param Eportfolio $eportfolio
     */
    public function __construct(Eportfolio $eportfolio)
    {
        $this->eportfolio = $eportfolio;
    }
}
