<?php

namespace App\Auditor\Tasks;

use App\Core\BaseRepository;

class TaskRepository extends BaseRepository
{
    /**
     * @var Task
     */
    protected $model;

    /**
     * @param Task $model
     */
    function __construct(Task $model)
    {
        $this->model = $model;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->add($data);
    }

    /**
     * @param $frequency
     * @return mixed
     */
    public function getByFrequency($frequency)
    {
        return $this->model->where('run_frequency', $frequency)->get();
    }

}