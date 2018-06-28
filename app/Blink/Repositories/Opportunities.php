<?php

namespace App\Blink\Repositories;

use App\Blink\Models\Opportunity;

class Opportunities extends BlinkRepository
{
    /**
     * @var Enquiry
     */
    protected $model;

    /**
     * Enquiries constructor.
     *
     * @param $model
     */
    public function __construct(Opportunity $model)
    {
        $this->model = $model;
    }
}