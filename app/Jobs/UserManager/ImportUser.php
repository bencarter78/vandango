<?php

namespace App\Jobs\UserManager;

use App\Jobs\Job;
use App\Portal\PortalUserImports;
use App\UserManager\Users\Account;
use App\Portal\PortalDepartmentMap;
use App\UserManager\Users\UserRepository;
use App\Events\UserManager\UserWasRegistered;

class ImportUser extends Job
{
    /**
     * @var
     */
    private $importedUser;

    /**
     * @var
     */
    private $users;

    /**
     * @var
     */
    private $user;

    /**
     * Create a new job instance.
     *
     * @param POPO $importedUser
     */
    public function __construct($importedUser)
    {
        $this->importedUser = $importedUser;
    }

    /**
     * Handle the command.
     *
     * @param Account             $account
     * @param UserRepository      $users
     * @param PortalDepartmentMap $map
     * @param PortalUserImports   $imports
     */
    public function handle(
        Account $account,
        UserRepository $users,
        PortalDepartmentMap $map,
        PortalUserImports $imports
    ) {
        $this->users = $users;

        if ($this->isImportable($users->findByEmail($this->importedUser->email), $imports)) {
            $this->create($account);
            $this->attachDepartments($map);
            $this->markUserImported($imports);

            event(new UserWasRegistered($this->user));
        }
    }

    /**
     * @param $user
     * @param $imports
     * @return bool
     */
    private function isImportable($user, $imports)
    {
        return ! ($this->isImported($user, $imports) || $this->exists($user));
    }

    /**
     * @param $user
     * @param $imports
     * @return bool
     */
    private function isImported($user, $imports)
    {
        return $user && $imports->wherePortalId($this->importedUser->id)->first();
    }

    /**
     * Checks to see if a staff member already exists matching the imported user's email.
     *
     * @param $user
     * @return bool
     */
    private function exists($user)
    {
        return $user ? $user->update(['deleted_at' => null]) : null;
    }

    /**
     * @param Account $account
     * @return array
     */
    private function create(Account $account)
    {
        $this->user = $account->create((array)$this->importedUser);
    }

    /**
     * @param $map
     * @return
     */
    private function attachDepartments($map)
    {
        return $map->whereId($this->importedUser->department)
                   ->whereNotNull('maps_to')
                   ->get()
                   ->each(function ($dept) {
                       $this->user->departments()->attach($dept->maps_to);
                   });
    }

    /**
     * @param $imports
     * @return void
     */
    private function markUserImported($imports)
    {
        $imports->create(['portal_id' => $this->importedUser->id]);
    }
}