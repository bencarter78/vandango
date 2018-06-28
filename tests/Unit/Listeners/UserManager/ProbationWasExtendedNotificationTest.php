<?php

namespace Tests\Unit\Listeners\UserManager;

use Tests\TestCase;
use App\UserManager\Users\UserMailer;
use App\Events\UserManager\ProbationEndDateWasUpdated;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Listeners\UserManager\ProbationWasEndedNotification;

/**
 * @group usermanager
 */
class ProbationWasExtendedNotificationTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_sends_a_notification_to_a_users_managers_when_probation_is_extened()
    {
        $user = $this->user(['departments' => $this->lineManager()->departments->first()->id]);

        $mailer = $this->mock(UserMailer::class);
        $mailer->shouldReceive('probationHasEndedNotification')->once();

        $event = $this->mock(ProbationEndDateWasUpdated::class);
        $event->endDate = date('Y-m-d');
        $event->user = $user;

        $listener = new ProbationWasEndedNotification($mailer);
        $listener->handle($event);
    }
}