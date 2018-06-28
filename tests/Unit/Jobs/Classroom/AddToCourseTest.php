<?php

namespace Tests\Unit\Jobs\Classroom;

use Tests\TestCase;
use App\RoomMate\Models\Room;
use App\Classroom\Models\Guest;
use App\UserManager\Users\User;
use App\Classroom\Models\Timetable;
use App\Jobs\Classroom\AddToCourse;
use App\Events\Classroom\UserWasAddedToScheduledCourse;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group classroom
 */
class AddToCourseTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    function it_adds_a_user_to_a_scheduled_course()
    {
        $this->expectsEvents([UserWasAddedToScheduledCourse::class]);

        $user = factory(User::class)->create();
        $courseInstance = factory(Timetable::class)->create();
        $userType = 'users';
        $job = new AddToCourse($user, $courseInstance, $userType, $this->groupUser('classroomAdmin'));
        $job->handle();

        $this->assertEquals(1, $courseInstance->load($userType)->count());
    }

    /** @test */
    function it_adds_a_guest_to_a_scheduled_course()
    {
        $this->expectsEvents([UserWasAddedToScheduledCourse::class]);

        $user = factory(Guest::class)->create();
        $courseInstance = factory(Timetable::class)->create();
        $userType = 'guests';

        $job = new AddToCourse($user, $courseInstance, $userType, $this->groupUser('classroomAdmin'));
        $job->handle();

        $this->assertEquals(1, $courseInstance->load($userType)->count());
    }

    /** @test */
    function it_returns_an_error_when_the_course_is_full()
    {
        $this->doesntExpectEvents([UserWasAddedToScheduledCourse::class]);

        $userType = 'users';
        $capacity = 2;
        $venue = factory(Room::class)->create(['capacity' => $capacity]);
        $courseInstance = factory(Timetable::class)->create(['room_id' => $venue->id]);

        $users = factory(User::class, $capacity)->create();
        $users->each(function ($u) use ($courseInstance) {
            $courseInstance->users()->attach($u->id);
        });

        $user = factory(User::class)->create();

        $job = new AddToCourse($user, $courseInstance, $userType, $this->groupUser('classroomAdmin'));

        $this->assertContains('Course capacity exceeded', $job->handle());
    }

    /** @test */
    function it_returns_an_error_when_the_attendee_is_already_attending()
    {
        $this->doesntExpectEvents([UserWasAddedToScheduledCourse::class]);

        $userType = 'users';
        $courseInstance = factory(Timetable::class)->create();
        $user = factory(User::class)->create();
        $courseInstance->users()->attach($user->id);

        $job = new AddToCourse($user, $courseInstance, $userType, $this->groupUser('classroomAdmin'));

        $this->assertContains('User exists', $job->handle());
    }

    /** @test */
    function it_adds_the_attendee_to_the_course_for_an_admin_user()
    {
        $this->expectsEvents([UserWasAddedToScheduledCourse::class]);

        $userType = 'users';
        $courseInstance = factory(Timetable::class)->create();
        $user = factory(User::class)->create();

        $job = new AddToCourse($user, $courseInstance, $userType, $this->groupUser('classroomAdmin'));
        $job->handle();
    }

    /** @test */
    function it_adds_the_attendee_to_the_course_for_their_manager()
    {
        $this->expectsEvents([UserWasAddedToScheduledCourse::class]);

        $department = $this->departments();
        $authUser = $this->sectorManager(['departments' => $department->id]);
        $department->update(['manager_id' => $authUser->id]);

        $userType = 'users';
        $courseInstance = factory(Timetable::class)->create();
        $user = factory(User::class)->create();
        $user->departments()->attach($department->id);

        $job = new AddToCourse($user, $courseInstance, $userType, $authUser);
        $job->handle();
    }
}
