<?php

namespace Tests\Unit\Listeners\Apply;

use Tests\TestCase;
use App\Apply\Models\Applicant;
use App\UserManager\Users\User;
use Illuminate\Support\Facades\Mail;
use App\Events\Apply\ApplicantWasAssigned;
use App\Mail\Apply\ApplicantAssignedToAdviser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Listeners\Apply\ApplicantAssignedToAdviserNotification;

class ApplicantAssignedToAdviserNotificationTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_sends_an_email_to_the_adviser_when_an_applicant_is_assigned_to_them()
    {
        Mail::fake();

        $adviser = $this->create(User::class);
        $applicant = $this->create(Applicant::class);
        $applicant->assignAdviser($adviser);
        $event = $this->mock(ApplicantWasAssigned::class);
        $event->applicant = $applicant;

        $listener = new ApplicantAssignedToAdviserNotification();
        $listener->handle($event);

        Mail::assertSent(ApplicantAssignedToAdviser::class, function ($mail) use ($adviser, $applicant) {
            return $mail->hasTo($adviser->email)
                && $mail->applicant->is($applicant);
        });
    }
}
