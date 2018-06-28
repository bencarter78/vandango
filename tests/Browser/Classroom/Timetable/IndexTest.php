<?php

namespace Tests\Browser\Classroom\Timetable;

use Tests\DuskTestCase;
use Tests\Traits\RoomMate;
use Tests\Traits\Classroom;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group classroom
 */
class IndexTest extends DuskTestCase
{
    use DatabaseMigrations, Classroom, RoomMate;

    /** @test */
    public function it_lists_all_timetabled_courses()
    {
        $timetable = $this->timetabledCourses();

        $this->browse(function ($browser) use ($timetable) {
            $browser->loginAs($this->admin('classroomAdmin'))
                    ->visit('classroom/timetable')
                    ->assertSee('Timetable')
                    ->waitForText($timetable->course->name)
                    ->assertSee($timetable->course->name)
                    ->assertVisible('a[name=edit]');
        });
    }

        /** @test */
        public function it_only_allows_actions_to_be_seen_by_admin()
        {
            $timetable = $this->timetabledCourses();

            $this->browse(function ($browser) use ($timetable) {
                $browser->loginAs($this->user())
                        ->visit('classroom/timetable')
                        ->assertSee('Timetable')
                        ->waitForText($timetable->course->name)
                        ->assertMissing('a[name=edit]');
            });
        }
}
