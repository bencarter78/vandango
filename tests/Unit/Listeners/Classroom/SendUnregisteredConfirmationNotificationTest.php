<?php

namespace Tests\Unit\Listeners\Classroom;

use Mail;
use Tests\TestCase;
use App\Classroom\Models\User;
use App\Classroom\Models\Guest;
use App\Classroom\Models\Timetable;
use App\Mail\Classroom\RemovedFromCourse;
use App\Events\Classroom\UserWasRemovedFromScheduledCourse;
use App\Listeners\Classroom\SendUnregisteredConfirmationNotification;

/**
 * @group classroom
 */
class SendUnregisteredConfirmationNotificationTest extends TestCase
{
    /** @test */
    public function it_sends_a_confirmation_when_a_user_is_unregistered_on_a_course()
    {
        Mail::fake();

        $user = $this->mock(User::class);
        $user->shouldReceive('getAttribute')->with('email')->andReturn('test@test.com');

        $event = $this->mock(UserWasRemovedFromScheduledCourse::class);
        $event->shouldReceive('getAttendee')->andReturn($user);
        $event->shouldReceive('getTimetable')->andReturn($this->mock(Timetable::class));

        $listener = new SendUnregisteredConfirmationNotification();
        $listener->handle($event);

        Mail::assertSent(RemovedFromCourse::class, function ($mail) {
            return $mail->hasTo('test@test.com');
        });
    }

    /** @test */
    public function it_sends_a_confirmation_when_a_guest_is_unregistered_on_a_course()
    {
        Mail::fake();

        $user = $this->mock(Guest::class);
        $user->shouldReceive('getAttribute')->with('email')->andReturn('test@test.com');

        $event = $this->mock(UserWasRemovedFromScheduledCourse::class);
        $event->shouldReceive('getAttendee')->andReturn($user);
        $event->shouldReceive('getTimetable')->andReturn($this->mock(Timetable::class));

        $listener = new SendUnregisteredConfirmationNotification();
        $listener->handle($event);

        Mail::assertSent(RemovedFromCourse::class, function ($mail) {
            return $mail->hasTo('test@test.com');
        });
    }
}