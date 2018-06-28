<?php

namespace App\Blink\Repositories;

use App\Blink\Models\Organisation;

class Organisations extends BlinkRepository
{
    /**
     * @var Organisation
     */
    protected $model;

    /**
     * Organisations constructor.
     *
     * @param $model
     */
    public function __construct(Organisation $model)
    {
        $this->model = $model;
    }
}