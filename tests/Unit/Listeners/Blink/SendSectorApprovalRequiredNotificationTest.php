<?php

namespace Tests\Unit\Listeners\Blink;

use Tests\TestCase;
use App\Blink\Models\Vacancy;
use Illuminate\Support\Facades\Mail;
use App\Events\Blink\VacancyWasReceived;
use App\Mail\Blink\VacancyApprovalRequired;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Listeners\Blink\SendSectorApprovalRequiredNotification;

/**
 * @group blink
 */
class SendSectorApprovalRequiredNotificationTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
        Mail::fake();
    }

    public function event($vacancy)
    {
        $event = $this->mock(VacancyWasReceived::class);
        $event->vacancy = $vacancy;

        return $event;
    }

    public function vacancy($user)
    {
        $vacancy = $this->mock(Vacancy::class);
        $vacancy->shouldReceive('getAttribute')->with('id')->andReturn(1);
        $vacancy->shouldReceive('getAttribute')->with('sector')->andReturn($user->sectors->first());

        return $vacancy;
    }

    public function listenFor($vacancy)
    {
        $listener = new SendSectorApprovalRequiredNotification();
        $listener->handle($this->event($vacancy));
    }

    /** @test */
    public function it_sends_a_notification_to_an_approver()
    {
        $user = $this->usersWithSector();
        $user->roles()->attach($this->roles(1, ['job_role' => config('vandango.blink.roles.approver')]));
        $vacancy = $this->vacancy($user);
        
        $this->listenFor($vacancy);

        Mail::assertSent(VacancyApprovalRequired::class, function ($mail) use ($user, $vacancy) {
            return $mail->vacancy->id === $vacancy->id &&
                $mail->hasTo($user->email);
        });
    }

    /** @test */
    public function it_sends_a_notification_to_a_department_manager_when_no_approvers_have_been_set()
    {
        $vacancy = $this->vacancy($this->usersWithSector());
        
        $this->listenFor($vacancy);

        Mail::assertSent(VacancyApprovalRequired::class, function ($mail) use ($vacancy) {
            return $mail->vacancy->id === $vacancy->id &&
                $mail->hasTo($vacancy->sector->department->manager->email);
        });
    }
}
