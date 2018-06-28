<?php
namespace App\UserManager\Users;

use App\Jobs\UserManager\UpdateUser;
use App\Jobs\UserManager\UpdateUserHr;
use App\Jobs\UserManager\UpdateUserPassword;
use App\Jobs\UserManager\UpdateUserMemberships;

class UpdateCommandTranslator
{
    /**
     * @var array
     */
    protected static $groups = [
        'general' => UpdateUser::class,
        'password' => UpdateUserPassword::class,
        'hr' => UpdateUserHr::class,
        'departments' => UpdateUserMemberships::class,
        'sectors' => UpdateUserMemberships::class,
        'roles' => UpdateUserMemberships::class,
        'groups' => UpdateUserMemberships::class,
    ];

    /**
     * @param $group
     * @return string
     */
    public static function translate($group)
    {
        return self::$groups[$group];
    }

}