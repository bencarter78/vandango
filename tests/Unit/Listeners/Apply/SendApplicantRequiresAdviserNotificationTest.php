<?php

namespace Tests\Unit\Listeners\Apply;

use Tests\TestCase;
use App\Apply\Models\Applicant;
use App\UserManager\Users\User;
use App\UserManager\Sectors\Sector;
use Illuminate\Support\Facades\Mail;
use App\Events\Apply\StartWasIdentified;
use App\Mail\Apply\ApplicantNeedsAdviser;
use App\UserManager\Departments\Department;
use App\Listeners\Apply\SendApplicantRequiresAdviserNotification;

/**
 * @group apply
 */
class SendApplicantRequiresAdviserNotificationTest extends TestCase
{
    /** @test */
    public function it_sends_a_notification_when_no_adviser_is_linked_to_an_adviser()
    {
        Mail::fake();

        $manager = new User();
        $manager->email = 'test@email.com';

        $department = $this->mock(Department::class);
        $department->shouldReceive('getAttribute')->with('manager')->andReturn($manager);

        $sector = $this->mock(Sector::class);
        $sector->shouldReceive('getAttribute')->with('department')->andReturn($department);

        $applicant = $this->mock(Applicant::class);
        $applicant->shouldReceive('getAttribute')->with('adviser_id')->andReturnNull();
        $applicant->shouldReceive('getAttribute')->with('sector')->andReturn($sector);

        $event = $this->mock(StartWasIdentified::class);
        $event->applicant = $applicant;

        $listener = new SendApplicantRequiresAdviserNotification();
        $listener->handle($event);

        Mail::assertSent(ApplicantNeedsAdviser::class, function ($mail) use ($manager) {
            return $mail->hasTo($manager->email);
        });
    }
}
