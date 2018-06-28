<?php

namespace Tests\Unit\UserManager\Users;

use Tests\TestCase;
use Illuminate\Auth\AuthManager;
use App\UserManager\Groups\Group;
use App\UserManager\Users\UserRepository;
use App\UserManager\Users\UserAuthorisation;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group usermanager
 */
class UserAuthorisationTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    function it_returns_true_when_an_admin_edits_a_staff_member()
    {
        $group = factory(Group::class)->create(['slug' => 'admin']);
        $currentUser = $this->user(['groups' => $group->id]);
        $userToEdit = $this->user();
        $repo = $this->mock(UserRepository::class);
        $repo->shouldReceive('findByIdOrUsername')->andReturn($userToEdit);
        $auth = $this->mock(AuthManager::class);
        $auth->shouldReceive('user')->andReturn($currentUser);

        $userAuth = new UserAuthorisation($repo, $auth);
        $this->assertTrue($userAuth->canEditUser($userToEdit->id));
    }

    /** @test */
    function it_returns_true_when_HR_edits_a_staff_member()
    {
        $hr = factory(Group::class)->create(['slug' => 'hr']);
        $currentUser = $this->user(['groups' => [$hr->id]]);
        $userToEdit = $this->user();
        $repo = $this->mock(UserRepository::class);
        $repo->shouldReceive('findByIdOrUsername')->andReturn($userToEdit);
        $auth = $this->mock(AuthManager::class);
        $auth->shouldReceive('user')->andReturn($currentUser);

        $userAuth = new UserAuthorisation($repo, $auth);
        $this->assertTrue($userAuth->canEditUser($userToEdit->id));
    }

    /** @test */
    function it_returns_true_when_a_manager_edits_a_staff_member()
    {
        $sector = $this->sectors();
        $department = $this->departments();
        $userToEdit = $this->user([
            'departments' => [$department->id],
            'sectors' => [$sector->id],
        ]);
        $manager = $this->sectorManager(['departments' => $department->id, 'sectors' => $sector->id]);
        $department->update(['manager_id' => $manager->id]);
        $repo = $this->mock(UserRepository::class);
        $repo->shouldReceive('findByIdOrUsername')->andReturn($userToEdit);
        $auth = $this->mock(AuthManager::class);
        $auth->shouldReceive('user')->andReturn($manager);

        $userAuth = new UserAuthorisation($repo, $auth);
        $this->assertTrue($userAuth->canEditUser($userToEdit->id));
    }

    /** @test */
    function it_returns_false_when_a_user_does_not_have_permission_to_edit_another_user()
    {
        $userToEdit = $this->user();
        $currentUser = $this->user();
        $repo = $this->mock(UserRepository::class);
        $repo->shouldReceive('findByIdOrUsername')->andReturn($userToEdit);
        $auth = $this->mock(AuthManager::class);
        $auth->shouldReceive('user')->andReturn($currentUser);

        $userAuth = new UserAuthorisation($repo, $auth);
        $this->assertFalse($userAuth->canEditUser($userToEdit->id));
    }

    /** @test */
    function it_returns_true_when_a_user_edits_their_own_account()
    {
        $userToEdit = $this->user();
        $repo = $this->mock(UserRepository::class);
        $repo->shouldReceive('findByIdOrUsername')->andReturn($userToEdit);
        $auth = $this->mock(AuthManager::class);
        $auth->shouldReceive('user')->andReturn($userToEdit);

        $userAuth = new UserAuthorisation($repo, $auth);
        $this->assertTrue($userAuth->canEditUser($userToEdit->id));
    }
}
