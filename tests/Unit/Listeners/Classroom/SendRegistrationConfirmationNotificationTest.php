<?php

namespace Tests\Unit\Listeners\Classroom;

use Mail;
use Tests\TestCase;
use App\Classroom\Models\User;
use App\Classroom\Models\Guest;
use App\Classroom\Models\Timetable;
use App\Mail\Classroom\UserRegistrationConfirmation;
use App\Mail\Classroom\GuestRegistrationConfirmation;
use App\Events\Classroom\UserWasAddedToScheduledCourse;
use App\Listeners\Classroom\SendRegistrationConfirmationNotification;

/**
 * @group classroom
 */
class SendRegistrationConfirmationNotificationTest extends TestCase
{
    /** @test */
    public function it_sends_a_confirmation_when_a_user_is_registered_on_a_course()
    {
        Mail::fake();

        $user = $this->mock(User::class);
        $user->shouldReceive('getAttribute')->with('email')->andReturn('test@test.com');

        $timetable = $this->mock(Timetable::class);
        $timetable->shouldReceive('getAttribute')->with('id');

        $event = $this->mock(UserWasAddedToScheduledCourse::class);
        $event->shouldReceive('getAttendee')->andReturn($user);
        $event->shouldReceive('getTimetable')->andReturn($timetable);

        $listener = new SendRegistrationConfirmationNotification();
        $listener->handle($event);

        Mail::assertSent(UserRegistrationConfirmation::class, function ($mail) {
            return $mail->hasTo('test@test.com');
        });

        Mail::assertNotSent(GuestRegistrationConfirmation::class);
    }

    /** @test */
    public function it_sends_a_confirmation_when_a_guest_is_registered_on_a_course()
    {
        Mail::fake();

        $user = $this->mock(Guest::class);
        $user->shouldReceive('getAttribute')->with('email')->andReturn('test@test.com');

        $event = $this->mock(UserWasAddedToScheduledCourse::class);
        $event->shouldReceive('getAttendee')->andReturn($user);
        $event->shouldReceive('getTimetable')->andReturn($this->mock(Timetable::class));

        $listener = new SendRegistrationConfirmationNotification();
        $listener->handle($event);

        Mail::assertNotSent(UserRegistrationConfirmation::class);
        Mail::assertSent(GuestRegistrationConfirmation::class, function ($mail) {
            return $mail->hasTo('test@test.com');
        });
    }
}