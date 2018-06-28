<?php

namespace Tests\Unit\UserManager\Groups;

use Tests\TestCase;
use App\UserManager\Groups\Group;
use App\UserManager\Groups\GroupRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group usermanager
 */
class GroupRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_all_users_belonging_to_a_group()
    {
        $group = $this->groups();
        $this->users(['groups' => $group->id], 2);
        $repo = new GroupRepository(new Group());
        $this->assertEquals(2, $repo->getGroupWithUsers($group->id)->users->count());
    }
}