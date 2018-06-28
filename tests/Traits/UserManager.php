<?php

namespace Tests\Traits;

use App\UserManager\Roles\Role;
use App\UserManager\Groups\Group;
use App\UserManager\Sectors\Sector;
use App\UserManager\Departments\Department;

trait UserManager
{
    /**
     * @param int   $count
     * @param array $atts
     * @return mixed
     */
    public function departments($count = 1, $atts = [])
    {
        return $this->create(Department::class, $count, $atts);
    }

    /**
     * @param int   $count
     * @param array $atts
     * @return mixed
     */
    public function sectors($count = 1, $atts = [])
    {
        return $this->create(Sector::class, $count, $atts);
    }

    /**
     * @param int   $count
     * @param array $atts
     * @return \Faker\Generator
     */
    public function groups($count = 1, $atts = [])
    {
        return $this->create(Group::class, $count, $atts);
    }

    /**
     * @param int   $count
     * @param array $atts
     * @return \Faker\Generator
     */
    public function roles($count = 1, $atts = [])
    {
        return $this->create(Role::class, $count, $atts);
    }

}