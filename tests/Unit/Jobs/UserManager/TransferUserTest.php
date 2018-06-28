<?php

namespace Tests\Unit\Jobs\UserManager;

use Tests\TestCase;
use App\UserManager\Users\User;
use App\Portal\PortalDepartmentMap;
use App\Jobs\UserManager\TransferUser;
use Illuminate\Database\Eloquent\Builder;
use App\UserManager\Users\UserRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group usermanager
 */
class TransferUserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function it_transfers_a_user_to_a_new_department()
    {
        $transfer = new \stdClass();
        $transfer->id = 1;
        $transfer->email = 'test.mctest@test.com';
        $transfer->department = 1;

        $eloquent = $this->mock(Builder::class);
        $eloquent->shouldReceive('detach');
        $eloquent->shouldReceive('sync');

        $repository = $this->mock(UserRepository::class);
        $repository->shouldReceive('findByEmail')->andReturn(new User);

        $importer = new TransferUser($transfer);
        $importer->handle($repository, new PortalDepartmentMap);
    }
}
