<?php

namespace App\Applications;

use App\Core\BaseRepository;

class ApplicationRepository extends BaseRepository
{
    /**
     * @var Application
     */
    protected $model;

    /**
     * @param Application $model
     */
    function __construct(Application $model)
    {
        $this->model = $model;
    }

    /**
     * @param bool|true $active
     * @return mixed
     */
    public function getApps($active = true)
    {
        return $this->model->where('active', $active)
                           ->orderBy('priority', 'DESC')
                           ->orderBy('title', 'ASC')
                           ->get();
    }

}