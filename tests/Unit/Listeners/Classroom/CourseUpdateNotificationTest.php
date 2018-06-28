<?php

namespace Tests\Unit\Listeners\Classroom;

use Tests\TestCase;
use App\Classroom\Models\User;
use App\Classroom\Models\Guest;
use App\Classroom\Models\Timetable;
use Illuminate\Support\Facades\Mail;
use App\Mail\Classroom\CourseWasUpdated;
use App\Events\Classroom\ScheduledCourseWasUpdated;
use App\Listeners\Classroom\CourseUpdateNotification;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group classroom
 */
class CourseUpdateNotificationTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_notifies_a_user_when_a_course_has_been_updated()
    {
        Mail::fake();

        $users = factory(User::class, 5)->create();
        $guests = factory(Guest::class, 5)->create();

        $timetable = $this->mock(Timetable::class);
        $timetable->shouldReceive('getAttribute')->with('users')->andReturn($users);
        $timetable->shouldReceive('getAttribute')->with('guests')->andReturn($guests);

        $event = $this->mock(ScheduledCourseWasUpdated::class);
        $event->shouldReceive('getTimetable')->andReturn($timetable);

        $listener = new CourseUpdateNotification();
        $listener->handle($event);

        Mail::assertSent(CourseWasUpdated::class, function ($mail) use ($users) {
            return $mail->hasTo($users->first()->email);
        });

        Mail::assertSent(CourseWasUpdated::class, function ($mail) use ($guests) {
            return $mail->hasTo($guests->first()->email);
        });
    }

}