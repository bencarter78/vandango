<?php
namespace Tests\Unit\Jobs\Blink;

use Tests\TestCase;
use App\Blink\Models\Status;
use App\Blink\Models\Enquiry;
use App\Blink\Models\Vacancy;
use App\Blink\Models\Rejection;
use App\UserManager\Users\User;
use App\Jobs\Blink\SaveActivity;
use Illuminate\Contracts\Auth\Guard;
use App\Events\Blink\VacancyWasApproved;
use App\Events\Blink\VacancyWasRejected;
use App\Jobs\Blink\ProcessVacancyApprovalDecision;

/**
 * @group blink
 */
class ProcessVacancyApprovalDecisionTest extends TestCase
{
    /**
     * @return \Mockery\MockInterface
     */
    public function status()
    {
        $status = $this->mock(Status::class);
        $status->shouldReceive('whereName')->once()->andReturnSelf();
        $status->shouldReceive('first')->once()->andReturnSelf();
        $status->shouldReceive('getAttribute')->with('id')->once()->andReturnSelf();
        $status->shouldReceive('attach')->once();

        return $status;
    }

    /**
     * @return \Mockery\MockInterface
     */
    public function auth()
    {
        $user = $this->mock(User::class);
        $user->shouldReceive('getAttribute')->with('id')->andReturn(1);

        $auth = $this->mock(Guard::class);
        $auth->shouldReceive('user')->once()->andReturn($user);

        return $auth;
    }

    /** @test */
    public function it_marks_a_vacancy_as_approved()
    {
        $this->expectsEvents(VacancyWasApproved::class);
        $this->expectsJobs(SaveActivity::class);

        $data = ['approve' => true];

        $status = $this->status();

        $vacancy = $this->mock(Vacancy::class);
        $vacancy->shouldReceive('update')->once()->andReturn(true);
        $vacancy->shouldReceive('statuses')->once()->andReturn($status);
        $vacancy->shouldReceive('getAttribute')->with('approved_by')->once()->andReturnSelf();
        $vacancy->shouldReceive('getAttribute')->with('title')->once()->andReturn('My Vacancy Title');
        $vacancy->shouldReceive('getAttribute')->with('enquiry')->once()->andReturnSelf($this->mock(Enquiry::class));

        $job = new ProcessVacancyApprovalDecision($data, $vacancy);
        $job->handle($this->auth(), $status);

        $this->assertNotNull($vacancy->approved_by);
    }

    /** @test */
    public function it_marks_a_vacancy_as_rejected()
    {
        $this->expectsEvents(VacancyWasRejected::class);
        $this->expectsJobs(SaveActivity::class);

        $data = ['reason' => 'My amazing reason'];

        $status = $this->status();

        $rejection = $this->mock(Rejection::class);
        $rejection->shouldReceive('create')->once()->andReturnSelf();

        $vacancy = $this->mock(Vacancy::class);
        $vacancy->shouldReceive('rejected')->once()->andReturn($rejection);
        $vacancy->shouldReceive('statuses')->once()->andReturn($status);
        $vacancy->shouldReceive('getAttribute')->with('id')->once()->andReturnSelf();
        $vacancy->shouldReceive('getAttribute')->with('title')->once()->andReturn('My Vacancy Title');
        $vacancy->shouldReceive('getAttribute')->with('enquiry')->once()->andReturnSelf($this->mock(Enquiry::class));
        $vacancy->shouldReceive('delete')->once();

        $job = new ProcessVacancyApprovalDecision($data, $vacancy);
        $job->handle($this->auth(), $status);
    }
}
