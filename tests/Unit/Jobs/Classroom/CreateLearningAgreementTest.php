<?php

namespace Tests\Unit\Jobs\Classroom;

use Tests\TestCase;
use App\Classroom\Models\User;
use App\UserManager\Users\Guest;
use App\Classroom\Models\Course;
use App\Classroom\Models\Timetable;
use App\Classroom\Models\LearningAgreement;
use App\Listeners\Classroom\CreateLearningAgreement;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Events\Classroom\UserWasAddedToScheduledCourse;

/**
 * @group classroom
 */
class CreateLearningAgreementTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    public function it_creates_a_learning_agreement_for_a_user()
    {
        $user = $this->mock(User::class);
        $user->shouldReceive('getAttribute')->with('id');
        $timetable = $this->mock(Timetable::class);
        $timetable->shouldReceive('getAttribute')->with('id');
        $course = $this->mock(Course::class);
        $model = $this->mock(LearningAgreement::class);
        $model->shouldReceive('create')->once();
        $event = $this->mock(UserWasAddedToScheduledCourse::class);
        $event->shouldReceive('getAttendee')->andReturn($user);
        $event->shouldReceive('getTimetable')->andReturn($timetable);
        $timetable->shouldReceive('getAttribute')->with('course')->andReturn($course);
        $course->shouldReceive('getAttribute')->with('is_agreement_required')->andReturn(true);

        $listener = new CreateLearningAgreement($model);
        $listener->handle($event);
    }

    /** @test */
    public function it_does_not_create_a_learning_agreement_for_a_user_when_not_required_by_the_course()
    {
        $user = $this->mock(User::class);
        $timetable = $this->mock(Timetable::class);
        $course = $this->mock(Course::class);
        $model = $this->mock(LearningAgreement::class);
        $event = $this->mock(UserWasAddedToScheduledCourse::class);
        $event->shouldReceive('getAttendee')->andReturn($user);
        $event->shouldReceive('getTimetable')->andReturn($timetable);
        $timetable->shouldReceive('getAttribute')->with('course')->andReturn($course);
        $course->shouldReceive('getAttribute')->with('is_agreement_required')->andReturn(false);

        $listener = new CreateLearningAgreement($model);
        $listener->handle($event);
    }

    /** @test */
    public function it_does_not_create_a_learning_agreement_for_a_guest()
    {
        $user = $this->mock(Guest::class);
        $model = $this->mock(LearningAgreement::class);
        $event = $this->mock(UserWasAddedToScheduledCourse::class);
        $event->shouldReceive('getAttendee')->andReturn($user);

        $listener = new CreateLearningAgreement($model);
        $listener->handle($event);
    }
}
