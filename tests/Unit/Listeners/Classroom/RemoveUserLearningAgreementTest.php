<?php

namespace Tests\Unit\Listeners\Classroom;

use Tests\TestCase;
use App\Classroom\Models\User;
use App\Classroom\Models\Course;
use App\Classroom\Models\Timetable;
use Illuminate\Database\Eloquent\Collection;
use App\Listeners\Classroom\RemoveUserLearningAgreement;
use App\Events\Classroom\UserWasRemovedFromScheduledCourse;

/**
 * @group classroom
 */
class RemoveUserLearningAgreementTest extends TestCase
{
    /** @test */
    public function it_deletes_a_users_learning_agreement_when_removed_as_an_attendee()
    {
        $agreement = $this->mock(LearningAgreement::class);
        $agreement->shouldReceive('forceDelete')->once();

        $collection = $this->mock(Collection::class);
        $collection->shouldReceive('first')->andReturn($agreement);
        $collection->shouldReceive('where')->andReturn($collection);

        $user = $this->mock(User::class);
        $user->shouldReceive('getAttribute')->with('agreements')->andReturn($collection);

        $course = $this->mock(Course::class);
        $course->shouldReceive('getAttribute')->with('is_agreement_required')->andReturn(true);

        $timetable = $this->mock(Timetable::class);
        $timetable->shouldReceive('getAttribute')->with('id');
        $timetable->shouldReceive('getAttribute')->with('course')->andReturn($course);

        $event = $this->mock(UserWasRemovedFromScheduledCourse::class);
        $event->shouldReceive('getAttendee')->andReturn($user);
        $event->shouldReceive('getTimetable')->andReturn($timetable);

        $listener = new RemoveUserLearningAgreement();
        $listener->handle($event);
    }
}