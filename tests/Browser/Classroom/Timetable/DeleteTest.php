<?php

namespace Tests\Browser\Classroom\Timetable;

use Tests\DuskTestCase;
use Tests\Traits\RoomMate;
use Tests\Traits\Classroom;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group classroom
 */
class DeleteTest extends DuskTestCase
{
    use DatabaseMigrations, Classroom, RoomMate;

    /** @test */
    public function it_deletes_a_timetabled_course()
    {
        $timetable = $this->timetabledCourses();
        $this->browse(function ($browser) use ($timetable) {
            $browser->logInAs($this->admin('classroomAdmin'))
                    ->visit('/classroom/timetable')
                    ->assertSee($timetable->course->name)
                    ->click("a[name=delete]")
                    ->whenAvailable('.modal-container', function ($modal) {
                        $modal->press('Delete');
                    })
                    ->waitForText('success')
                    ->assertDontSee($timetable->course->name);
        });
    }
}
