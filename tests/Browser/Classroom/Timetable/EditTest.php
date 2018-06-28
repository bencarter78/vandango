<?php

namespace Tests\Browser\Classroom\Timetable;

use Tests\DuskTestCase;
use Tests\Traits\RoomMate;
use Tests\Traits\Classroom;
use App\Classroom\Models\Course;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group classroom
 */
class EditTest extends DuskTestCase
{
    use DatabaseMigrations, Classroom, RoomMate;

    /** @test */
    public function it_can_edit_a_timetabled_course()
    {
        $timetable = $this->timetabledCourses();
        $course = $this->create(Course::class, 1, ['course_type_id' => 1]);
        $this->browse(function ($browser) use ($timetable, $course) {
            $browser->loginAs($this->admin('classroomAdmin'))
                    ->visit('classroom/timetable')
                    ->click('a[name=edit]')
                    ->assertSelected('course_id', "$timetable->course_id")
                    ->assertInputValue('search[user_id]', $timetable->trainer->present()->name)
                    ->assertInputValue('search[room_id]', $timetable->venue->name . ' - ' . $timetable->venue->site->name . ', ' . $timetable->venue->site->location->town)
                    ->assertInputValue('start_date', $timetable->starts_at->format('d/m/Y'))
                    ->assertInputValue('end_date', $timetable->ends_at->format('d/m/Y'))
                    ->assertSelected('start_time', "{$timetable->starts_at->format('H:i')}")
                    ->assertSelected('end_time', "{$timetable->ends_at->format('H:i')}")
                    ->select('course_id', "$course->id")
                    ->press('Save')
                    ->assertPathIs('/classroom/timetable')
                    ->waitForText($course->name)
                    ->assertSee($course->name);
        });
    }
}
