<?php

namespace Tests\Unit\Jobs\UserManager;

use Tests\TestCase;
use App\UserManager\Users\User;
use App\Portal\PortalUserImports;
use App\UserManager\Users\Account;
use App\Portal\PortalDepartmentMap;
use App\Jobs\UserManager\ImportUser;
use App\UserManager\Users\UserRepository;
use App\Events\UserManager\UserWasRegistered;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group usermanager
 */
class ImportUserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function it_imports_a_portal_user()
    {
        $this->expectsEvents(UserWasRegistered::class);

        $importedUser = (object)[
            'id' => 1,
            'email' => 'test.mctest@test.com',
            'department' => 1,
        ];

        $repository = $this->mock(UserRepository::class);
        $repository->shouldReceive('findByEmail')->andReturnNull();

        $account = $this->mock(Account::class);
        $account->shouldReceive('create')->andReturn($this->mock(User::class));

        $importer = new ImportUser($importedUser);
        $importer->handle($account, $repository, new PortalDepartmentMap, new PortalUserImports);
    }
}
