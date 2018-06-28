<?php

namespace App\UserManager\Users;

use App\Core\BaseModel;
use Laracasts\Presenter\PresentableTrait;

class UserMeta extends BaseModel
{
    use PresentableTrait;

    /**
     * @var string
     */
    protected $presenter = UserMetaPresenter::class;

    /**
     * @var string
     */
    protected $table = 'users_meta';

    /**
     * @var array
     */
    protected $fillable = ['tel', 'mobile', 'ext', 'start_date', 'probation_end_date', 'appraisal_date'];

    /**
     * @var array
     */
    protected $dates = ['start_date', 'probation_end_date', 'appraisal_date'];
}