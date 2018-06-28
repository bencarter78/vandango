<?php

namespace Tests\Unit\Listeners\Classroom;

use Mail;
use Tests\TestCase;
use App\Classroom\Models\User;
use App\Classroom\Models\Timetable;
use App\Mail\Classroom\CourseAbsentee;
use App\Events\Classroom\UserWasAbsentFromCourse;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Listeners\Classroom\UserAbsentFromCourseNotification;

/**
 * @group classroom
 */
class UserAbsentFromCourseNotificationTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_sends_a_notification_to_a_user_when_absent_from_course()
    {
        Mail::fake();

        $user = factory(User::class)->create();
        $timetable = factory(Timetable::class)->create();

        $event = $this->mock(UserWasAbsentFromCourse::class);
        $event->shouldReceive('getAttendee')->andReturn($user);
        $event->shouldReceive('getTimetable')->andReturn($timetable);

        $listener = new UserAbsentFromCourseNotification();
        $listener->handle($event);

        Mail::assertSent(CourseAbsentee::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }
}