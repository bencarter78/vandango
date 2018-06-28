<?php

namespace App\Jobs\UserManager;

use App\Jobs\Job;
use App\Portal\PortalDepartmentMap;
use App\UserManager\Users\UserRepository;

class TransferUser extends Job
{
    /**
     * @var
     */
    private $transferredUser;

    /**
     * @var
     */
    private $user;

    /**
     * Create a new job instance.
     *
     * @param $user Portal User
     */
    public function __construct($user)
    {
        $this->transferredUser = $user;
    }

    /**
     * Handle the command.
     *
     * @param UserRepository      $users
     * @param PortalDepartmentMap $map
     */
    public function handle(UserRepository $users, PortalDepartmentMap $map)
    {
        $this->user = $users->findByEmail($this->transferredUser->email);
        $this->syncRelationships($map);
    }

    /**
     * @param $map
     * @return
     */
    public function syncRelationships($map)
    {
        $this->user->sectors()->detach();
        $this->user->roles()->detach();

        return $map->whereId($this->transferredUser->department)
                   ->whereNotNull('maps_to')
                   ->get()
                   ->each(function ($dept) {
                       $this->user->departments()->sync($dept->maps_to);
                   });
    }
}