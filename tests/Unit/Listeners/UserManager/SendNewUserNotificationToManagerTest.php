<?php

namespace Tests\Unit\Listeners\UserManager;

use Tests\TestCase;
use App\UserManager\Users\UserMailer;
use App\UserManager\Users\UserRepository;
use App\Events\UserManager\UserWasRegistered;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Listeners\UserManager\SendNewUserNotificationToManager;

/**
 * @group usermanager
 */
class SendNewUserNotificationToManagerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_sends_a_notification_to_a_line_manager_about_a_new_user()
    {
        $department = $this->lineManager()->departments->first();
        $user = $this->user(['departments' => $department->id]);

        $mailer = $this->mock(UserMailer::class);
        $mailer->shouldReceive('notifyManagerOfNewUser')->once();

        $repo = $this->mock(UserRepository::class);
        $repo->shouldReceive('requireById')->andReturn($department);

        $event = $this->mock(UserWasRegistered::class);
        $event->shouldReceive('getUser')->andReturn($user);

        $listener = new SendNewUserNotificationToManager($mailer, $repo);
        $listener->handle($event);
    }
}