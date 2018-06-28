<?php

namespace App\Judi\Repositories;

use App\Core\BaseRepository;
use App\Judi\Models\Cancellation;

class CancellationRepository extends BaseRepository
{
    /**
     * @var Grade
     */
    protected $model;

    /**
     * @param Cancellation $model
     */
    function __construct(Cancellation $model)
    {
        $this->model = $model;
    }

}