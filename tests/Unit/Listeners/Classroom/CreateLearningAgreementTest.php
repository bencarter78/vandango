<?php

namespace Tests\Unit\Listeners\Classroom;

use Tests\TestCase;
use App\Classroom\Models\User;
use App\Classroom\Models\Guest;
use App\Classroom\Models\Course;
use App\Classroom\Models\Timetable;
use App\Classroom\Models\LearningAgreement;
use App\Listeners\Classroom\CreateLearningAgreement;
use App\Events\Classroom\UserWasAddedToScheduledCourse;

/**
 * @group classroom
 */
class CreateLearningAgreementTest extends TestCase
{
    /** @test */
    public function it_creates_a_user_learning_agreement_when_a_course_requires_it()
    {
        $user = $this->mock(User::class);
        $user->shouldReceive('getAttribute')->with('id');

        $course = $this->mock(Course::class);
        $course->shouldReceive('getAttribute')->with('is_agreement_required')->andReturn(true);

        $timetable = $this->mock(Timetable::class);
        $timetable->shouldReceive('getAttribute')->with('id');
        $timetable->shouldReceive('getAttribute')->with('course')->andReturn($course);

        $event = $this->mock(UserWasAddedToScheduledCourse::class);
        $event->shouldReceive('getAttendee')->andReturn($user);
        $event->shouldReceive('getTimetable')->andReturn($timetable);

        $agreement = $this->mock(LearningAgreement::class);
        $agreement->shouldReceive('create')->once();

        $listener = new CreateLearningAgreement($agreement);
        $listener->handle($event);
    }

    /** @test */
    public function it_does_not_create_a_user_learning_agreement_when_a_course_does_not_require_it()
    {
        $user = $this->mock(User::class);
        $course = $this->mock(Course::class);
        $course->shouldReceive('getAttribute')->with('is_agreement_required')->andReturn(false);

        $timetable = $this->mock(Timetable::class);
        $timetable->shouldReceive('getAttribute')->with('course')->andReturn($course);

        $event = $this->mock(UserWasAddedToScheduledCourse::class);
        $event->shouldReceive('getAttendee')->andReturn($user);
        $event->shouldReceive('getTimetable')->andReturn($timetable);

        $agreement = $this->mock(LearningAgreement::class);
        $agreement->shouldNotReceive('create');

        $listener = new CreateLearningAgreement($agreement);
        $listener->handle($event);
    }

    /** @test */
    public function it_does_not_create_a_guest_learning_agreement_when_a_course_requires_it()
    {
        $user = $this->mock(Guest::class);
        $course = $this->mock(Course::class);

        $timetable = $this->mock(Timetable::class);
        $timetable->shouldReceive('getAttribute')->with('course')->andReturn($course);

        $event = $this->mock(UserWasAddedToScheduledCourse::class);
        $event->shouldReceive('getAttendee')->andReturn($user);
        $event->shouldReceive('getTimetable')->andReturn($timetable);

        $agreement = $this->mock(LearningAgreement::class);
        $agreement->shouldNotReceive('create');

        $listener = new CreateLearningAgreement($agreement);
        $listener->handle($event);
    }
}