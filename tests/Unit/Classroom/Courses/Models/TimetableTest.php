<?php

namespace Tests\Unit\Classroom\Models;

use Tests\TestModel;
use App\Classroom\Models\User;
use App\Classroom\Models\Guest;
use App\Classroom\Models\Timetable;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group classroom
 */
class TimetableTest extends TestModel
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    function it_returns_the_number_attendees_for_a_scheduled_course()
    {
        $timetable = factory(Timetable::class)->create();

        $timetable->users()->attach(
            factory(User::class, 1)->create()->pluck('id')->all()
        );

        $timetable->guests()->attach(
            factory(Guest::class, 1)->create()->pluck('id')->all()
        );

        $this->assertEquals(2, $timetable->cohortSize());
    }
}
