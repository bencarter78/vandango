<?php

namespace Tests\Traits;

use Faker\Factory;
use App\UserManager\Users\User;
use App\UserManager\Groups\Group;
use App\UserManager\Users\UserMeta;

trait UserTypes
{
    /**
     * @param array $memberships
     * @return mixed
     */
    public function user($memberships = [])
    {
        $user = factory(User::class)->create();
        $user->meta()->save(factory(UserMeta::class)->make());

        foreach ($memberships as $k => $v) {
            $user->{$k}()->attach($v);
        }

        return $user;
    }

    /**
     * @param     $memberships
     * @param int $count
     * @return mixed
     */
    public function users($memberships, $count = 1)
    {
        for ($i = 0; $i < $count; $i++) {
            $users[] = $this->user($memberships);
        }

        return collect($users);
    }

    /**
     * @param int $count
     * @return mixed
     */
    public function userWithDepartment($count = 1)
    {
        return $this->users(['departments' => [$this->departments()->id]], $count);
    }

    /**
     * @param int $count
     * @return mixed
     */
    public function usersWithSector($count = 1)
    {
        $users = $this->users(['sectors' => [$this->sectors()->id]], $count);

        return $count === 1 ? $users->first() : $users;
    }

    /**
     * @return mixed
     */
    public function superuser()
    {
        return $this->user(['groups' => factory(Group::class)->create(['slug' => 'admin'])]);
    }

    /**
     * @param array $atts
     * @return mixed
     */
    public function sectorManager($atts = [])
    {
        return $this->user($atts);
    }

    /**
     * @return mixed
     */
    public function lineManager()
    {
        return $this->user([
            'roles' => $this->roles(1, ['job_role' => config('vandango.usermanager.departments.manager.name')])->id,
            'departments' => $this->sectors()->department->id,
        ]);
    }

    /**
     * @param int $count
     * @return array
     */
    public function picsLearner($count = 1)
    {
        $data = [];
        $faker = Factory::create();
        for ($i = 0; $i < $count; $i++) {
            $learner = new \stdClass();
            $learner->email = $faker->email;
            $learner->name = $faker->name;
            $data[] = $learner;
        }

        return $data;
    }

    /**
     * @param string|array $groupSlug
     * @return mixed
     */
    public function groupUser($groupSlug)
    {
        $groupIds = [];

        if (is_array($groupSlug)) {
            foreach ($groupSlug as $slug) {
                $groupIds[] = $this->groups(1, ['slug' => $slug])->id;
            }
        } else {
            $groupIds = $this->groups(1, ['slug' => $groupSlug])->id;
        }

        return $this->user(['groups' => $groupIds]);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function admin($slug)
    {
        return $this->user(['groups' => $this->create(Group::class, 1, ['slug' => $slug])]);
    }

}