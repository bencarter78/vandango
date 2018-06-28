<?php

namespace Tests\Unit\UserManager\Users;

use Tests\TestModel;
use App\UserManager\Users\UserMeta;

/**
 * @group usermanager
 */
class UserMetaTest extends TestModel
{
    protected $model = UserMeta::class;

    protected $fillable = ['tel', 'mobile', 'ext', 'start_date', 'probation_end_date', 'appraisal_date'];

    protected $dates = ['start_date', 'probation_end_date', 'appraisal_date'];
}
