<?php

namespace App\Judi\Repositories;

use App\Judi\Models\Grade;
use App\Core\BaseRepository;

class GradeRepository extends BaseRepository
{
    /**
     * @var Grade
     */
    protected $model;

    /**
     * @param Grade $model
     */
    function __construct(Grade $model)
    {
        $this->model = $model;
    }
}