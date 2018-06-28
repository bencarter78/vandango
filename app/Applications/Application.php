<?php

namespace App\Applications;

use App\Core\BaseModel;

class Application extends BaseModel
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string
     */
    protected $table = 'data_applications';

}
