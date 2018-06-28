<?php

namespace Tests\Unit\Listeners\UserManager;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\UserManager\Users\UserMailer;
use App\Events\UserManager\UserMembershipsWereUpdated;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Listeners\UserManager\SendNotificationsOfDepartmentChange;

/**
 * @group usermanager
 */
class SendNotificationOfDepartmentChangeTest extends TestCase
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

        $request = $this->mock(Request::class);
        $request->department_id = [$this->departments()->id];

        $event = $this->mock(UserMembershipsWereUpdated::class);
        $event->shouldReceive('getRequest')->andReturn($request);
        $event->shouldReceive('getUser')->andReturn($user);

        $listener = new SendNotificationsOfDepartmentChange($department, $mailer);
        $listener->handle($event);
    }

    /** @test */
    public function it_does_not_send_a_notification_to_an_existing_manager()
    {
        $department = $this->lineManager()->departments->first();
        $user = $this->user(['departments' => $department->id]);

        $mailer = $this->mock(UserMailer::class);
        $mailer->shouldNotReceive('notifyManagerOfNewUser');

        $request = $this->mock(Request::class);
        $request->department_id = null;

        $event = $this->mock(UserMembershipsWereUpdated::class);
        $event->shouldReceive('getRequest')->andReturn($request);
        $event->shouldReceive('getUser')->andReturn($user);

        $listener = new SendNotificationsOfDepartmentChange($department, $mailer);
        $listener->handle($event);
    }
}