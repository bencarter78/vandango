<?php

namespace Tests\Unit\Blink\Models;

use Tests\TestCase;
use App\Blink\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_true_when_a_user_can_approve_a_vacancy()
    {
        $sector = $this->sectors();
        $role = $this->roles(1, ['job_role' => config('vandango.blink.roles.approver')]);
        $user = factory(User::class)->create();
        $user->sectors()->attach($sector->id);
        $user->roles()->attach($role->id);
        $this->assertTrue($user->canApproveVacancy($sector->name));
    }
}
