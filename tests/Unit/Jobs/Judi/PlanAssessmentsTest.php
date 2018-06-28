<?php

namespace Tests\Unit\Jobs\Judi;

use App\Judi\Pa;
use Carbon\Carbon;
use Tests\TestCase;
use Tests\Traits\Judi;
use App\Judi\Models\Role;
use App\Judi\Models\Sector;
use App\Judi\AssessmentDate;
use App\Jobs\Judi\PlanAssessments;
use App\Judi\Models\SectorSchedule;
use App\Exceptions\NoEligiblePaException;
use App\Judi\Repositories\AssessmentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Jobs\Judi\SendFailedAssessmentGenerationNotification;

/**
 * @group judi
 */
class PlanAssessmentsTest extends TestCase
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    public function newUser($processes = [])
    {
        $role = factory(Role::class)->create();
        $role->processes()->attach($processes);
        $user = $this->user();
        $user->roles()->attach($role->id);

        return $user;
    }

    public function existingUser($processes = [])
    {
        $user = $this->newUser($processes);
        $user->meta->probation_end_date = null;

        return $user;
    }

    /** @test */
    public function it_creates_the_required_assessments_for_a_user_on_probation()
    {
        // Set up new user with 3 processes
        $processes = $this->processes(3);
        $sector = factory(Sector::class)->create();
        $user = $this->newUser($processes->pluck('id')->all());
        $user->sectors()->attach($sector->id);

        $repo = $this->mock(AssessmentRepository::class);
        $repo->shouldReceive('getProcessAssessmentsByUser')->andReturn(collect());
        $repo->shouldReceive('add')->times(3)->andReturn($this->assessments(3, ['user_id' => $user->id]));

        $pa = $this->mock(Pa::class);
        $pa->shouldReceive('assign')->andReturn($this->pa());

        $date = $this->mock(AssessmentDate::class);
        $date->shouldReceive('assign')->andReturn(date('Y-m-d'));

        $job = new PlanAssessments($user, $sector);
        $job->handle($repo, $pa, $date);

        $this->assertEquals(3, $user->assessments->count());
    }

    /** @test */
    public function it_does_not_create_an_assessment_for_a_given_user_when_one_is_already_scheduled()
    {
        $user = $this->existingUser();

        $assessment = $this->assessments(1, ['user_id' => $user->id]);

        $repo = $this->mock(AssessmentRepository::class);
        $repo->shouldReceive('getProcessAssessmentsByUser')->andReturn(collect($assessment));
        $repo->shouldNotReceive('add');

        $job = new PlanAssessments($user, $assessment->sector);
        $job->handle($repo, $this->mock(Pa::class), $this->mock(AssessmentDate::class));
    }

    /** @test */
    public function it_does_not_create_an_assessment_for_a_new_user_for_excluded_processes()
    {
        $processes = $this->processes(1, [
            'name' => config('vandango.judi.processes.excludedForProbation')[0],
        ]);

        $user = $this->newUser($processes->pluck('id')->all());

        $sector = factory(Sector::class)->create();

        $repo = $this->mock(AssessmentRepository::class);
        $repo->shouldReceive('getProcessAssessmentsByUser')->andReturn(collect([]));
        $repo->shouldNotReceive('add');

        $job = new PlanAssessments($user, $sector);
        $job->handle($repo, $this->mock(Pa::class), $this->mock(AssessmentDate::class));
    }

    /** @test */
    public function it_creates_an_assessment_for_a_due_sector()
    {
        $sector = factory(SectorSchedule::class)->create([
            'month' => Carbon::now()->addMonth()->format('n'),
        ])->sector;

        $user = $this->existingUser($this->processes()->id);
        $user->sectors()->attach($sector->id);

        $repo = $this->mock(AssessmentRepository::class);
        $repo->shouldReceive('getProcessAssessmentsByUser')->andReturn(collect());
        $repo->shouldReceive('add')->once();

        $pa = $this->mock(Pa::class);
        $pa->shouldReceive('assign')->andReturn($this->pa());

        $date = $this->mock(AssessmentDate::class);
        $date->shouldReceive('assign')->andReturn(date('Y-m-d'));

        $job = new PlanAssessments($user, $sector);
        $job->handle($repo, $pa, $date);

        $this->assertEquals(0, $user->assessments->count());
    }

    /** @test */
    public function it_does_not_create_an_assessment_for_a_sector_not_due()
    {
        $sector = factory(SectorSchedule::class)->create([
            'month' => Carbon::now()->addMonths(10)->format('n'),
        ])->sector;

        $processes = $this->processes(3);

        $user = $this->existingUser($processes->pluck('id')->all());
        $user->sectors()->attach($sector->id);

        $repo = $this->mock(AssessmentRepository::class);
        $repo->shouldReceive('getProcessAssessmentsByUser')->andReturn(collect());
        $repo->shouldNotReceive('add');

        $job = new PlanAssessments($user, $sector);
        $job->handle($repo, $this->mock(Pa::class), $this->mock(AssessmentDate::class));
    }

    /** @test */
    public function it_sends_a_notification_when_there_an_exception_is_thrown()
    {
        $this->expectsJobs(SendFailedAssessmentGenerationNotification::class);

        $sector = factory(Sector::class)->create();

        $processes = $this->processes(3);

        $user = $this->newUser($processes->pluck('id')->all());
        $user->sectors()->attach($sector->id);

        $repo = $this->mock(AssessmentRepository::class);
        $repo->shouldReceive('getProcessAssessmentsByUser')->andReturn(collect());
        $repo->shouldReceive('add');

        $pa = $this->mock(Pa::class);
        $pa->shouldReceive('assign')->andThrow(NoEligiblePaException::class);

        $job = new PlanAssessments($user, $sector);
        $job->handle($repo, $pa, $this->mock(AssessmentDate::class));
    }
}
