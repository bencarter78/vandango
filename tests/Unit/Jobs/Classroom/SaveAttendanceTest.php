<?php

namespace Tests\Unit\Jobs\Classroom;

use Tests\TestCase;
use App\UserManager\Users\User;
use App\Classroom\Models\Timetable;
use App\Jobs\Classroom\SaveAttendance;
use App\Events\Classroom\UserAttendedCourse;
use App\Events\Classroom\UserWasAbsentFromCourse;
use App\Classroom\Repositories\Timetable as Repository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group classroom
 */
class SaveAttendanceTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    function it_records_user_attendance_at_a_course()
    {
        $this->expectsEvents([UserAttendedCourse::class]);
        $this->doesntExpectEvents([UserWasAbsentFromCourse::class]);

        $user = factory(User::class)->create();
        $timetable = factory(Timetable::class)->create();
        $timetable->users()->attach($user->id);

        $repository = $this->mock(Repository::class);
        $repository->shouldReceive('requireById')->andReturn($timetable);

        $job = new SaveAttendance([
            'timetableId' => $timetable->id,
            'userId' => $user->id,
            'attended' => true,
            'type' => 'users',
        ]);

        $job->handle($repository);

        $this->assertDatabaseHas('classroom_cohorts', [
            'attendee_id' => $user->id,
            'timetable_id' => $timetable->id,
            'attended' => 1,
        ]);
    }

    /** @test */
    function it_records_user_absence_at_a_course()
    {
        $this->doesntExpectEvents([UserAttendedCourse::class]);
        $this->expectsEvents([UserWasAbsentFromCourse::class]);

        $user = factory(User::class)->create();
        $timetable = factory(Timetable::class)->create();
        $timetable->users()->attach($user->id);

        $repository = $this->mock(Repository::class);
        $repository->shouldReceive('requireById')->andReturn($timetable);

        $job = new SaveAttendance([
            'timetableId' => $timetable->id,
            'userId' => $user->id,
            'attended' => false,
            'type' => 'users',
        ]);

        $job->handle($repository);

        $this->assertDatabaseHas('classroom_cohorts', [
            'attendee_id' => $user->id,
            'timetable_id' => $timetable->id,
            'attended' => 0,
        ]);
    }
}
