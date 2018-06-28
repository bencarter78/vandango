<?php

namespace Tests\Unit\Listeners\Judi;

use Tests\TestCase;
use Tests\Traits\Judi;
use App\Jobs\Judi\PlanAssessments;
use App\Judi\Repositories\UserRepository;
use App\Events\UserManager\UserMembershipsWereUpdated;
use App\Listeners\Judi\CheckUserHasRequiredAssessments;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group judi
 */
class CheckUserHasRequiredAssessmentsTest extends TestCase
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    public function it_dispatches_jobs_to_plan_assessments_for_a_given_user()
    {
        $this->expectsJobs(PlanAssessments::class);

        $user = $this->user();
        $user->sectors()->attach($this->sectors()->id);

        $event = $this->mock(UserMembershipsWereUpdated::class);
        $event->shouldReceive('getUser')->once()->andReturn($user);

        $repo = $this->mock(UserRepository::class);
        $repo->shouldReceive('requireById')->once()->andReturn($user);

        $listener = new CheckUserHasRequiredAssessments($repo);
        $listener->handle($event);
    }

    /** @test */
    public function it_does_not_dispatch_job_when_user_has_no_sectors()
    {
        $this->doesntExpectJobs(PlanAssessments::class);

        $user = $this->user();

        $event = $this->mock(UserMembershipsWereUpdated::class);
        $event->shouldReceive('getUser')->once()->andReturn($user);

        $repo = $this->mock(UserRepository::class);
        $repo->shouldReceive('requireById')->once()->andReturn($user);

        $listener = new CheckUserHasRequiredAssessments($repo);
        $listener->handle($event);
    }
}
