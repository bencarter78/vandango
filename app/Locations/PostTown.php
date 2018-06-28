<?php

namespace App\Locations;

use App\Core\BaseModel;

class PostTown extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'data_post_towns';

    /**
     * @var bool
     */
    public $timestamps = false;
}
