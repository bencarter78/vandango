<?php

namespace App\UserManager\Users;

use App\Core\BaseRepository;

class GuestRepository extends BaseRepository
{
    /**
     * @var
     */
    protected $model;

    /**
     * Guest constructor.
     *
     * @param $model
     */
    public function __construct(Guest $model)
    {
        $this->model = $model;
    }
}