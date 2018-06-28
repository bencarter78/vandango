<?php

namespace App\Locations;

use App\Core\BaseModel;
use Laracasts\Presenter\PresentableTrait;

class Centre extends BaseModel
{
    use PresentableTrait;

    /**
     * @var
     */
    protected $presenter = CentresPresenter::class;

    /**
     * @var string
     */
    protected $table = 'data_centres';

    /**
     * @var array
     */
    protected $fillable = ['add1', 'add2', 'add3', 'add4', 'add5', 'post_code', 'tel'];
}