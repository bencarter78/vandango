<?php

namespace Tests\Unit\Judi\Repositories;

use Tests\TestCase;
use Tests\Traits\Judi;
use App\Judi\Models\User;
use App\Judi\Repositories\UserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group judi
 */
class UserRepositoryTest extends TestCase
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    public function it_returns_all_staff()
    {
        $this->users([], 2);
        $repo = new UserRepository(new User());
        $this->assertEquals(2, $repo->getStaff()->count());
    }

    /** @test */
    public function it_syncs_an_assessors_processes()
    {
        $pa = $this->pa();
        $data = $this->processes(2)->pluck('id')->all();
        $repo = new UserRepository(new User());
        $repo->updateProcesses($pa->id, $data);
        $this->assertEquals(2, $pa->processes->count());
    }

    /** @test */
    public function it_returns_all_assessors_who_can_assess_process()
    {
        $pa = $this->pa();
        $this->user();
        $process = $this->processes(1);
        $pa->processes()->attach($process->id);

        $repo = new UserRepository(new User());
        $this->assertEquals(1, $repo->getProcessAssessors($process->id)->count());
    }

    /** @test */
    public function it_returns_all_assessable_staff_for_a_given_sector()
    {
        $role = $this->roles();

        $this->processes()->roles()->attach($role->id);

        $sector = $this->sectors();

        $this->users([], 3)->each(function ($u) use ($sector, $role) {
            $u->sectors()->attach($sector->id);
            $u->roles()->attach($role->id);
        });

        $repo = new UserRepository(new User());

        $this->assertEquals(3, $repo->getAssessableSectorStaff($sector)->count());
    }

    /** @test */
    public function it_returns_all_judi_admin()
    {
        $this->admin(config('vandango.judiAdminSlug'));

        $repo = new UserRepository(new User());

        $this->assertEquals(1, $repo->getJudiAdmin()->count());
    }

    /** @test */
    public function it_returns_all_user_processes()
    {
        $role = $this->roles();

        $this->processes(2)->each(function ($p) use ($role) {
            $p->roles()->attach($role->id);
        });

        $user = factory(User::class)->create();

        $user->roles()->attach($role->id);

        $repo = new UserRepository(new User());

        $this->assertEquals(2, $repo->getUserProcesses($user)->count());
    }

    /** @test */
    public function it_returns_all_scheduled_assessments_for_a_given_user_and_process()
    {
        $user = $this->user();

        $process = $this->processes();

        $this->assessments(3, ['user_id' => $user->id, 'process_id' => $process->id]);

        $repo = new UserRepository(new User());

        $this->assertEquals(3, $repo->userHasProcessAssessmentScheduled($user, $process)->count());
    }
}
