<?php

namespace Tests\Browser\Classroom\Timetable;

use Carbon\Carbon;
use Tests\DuskTestCase;
use Tests\Traits\RoomMate;
use Tests\Traits\Classroom;
use App\Classroom\Models\Timetable;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group classroom
 */
class CreateTest extends DuskTestCase
{
    use DatabaseMigrations, Classroom, RoomMate;

    /** @test */
    public function it_can_create_a_new_timetabled_course()
    {
        $timetable = $this->make(Timetable::class, 1);
        $room = $this->rooms();
        $user = $this->userWithDepartment()->first();
        $this->browse(function ($browser) use ($timetable, $room, $user) {
            $date = Carbon::now();
            $browser->loginAs($this->admin('classroomAdmin'))
                    ->visit('classroom/timetable')
                    ->clickLink('Add')
                    ->assertSee('Create')
                    ->select('course_id', "$timetable->course_id")
                    ->type('search[user_id]', $user->first_name)
                    ->pause(10000)
                    ->whenAvailable('.results', function ($results) use ($user) {
                        $results->click('.results-item');
                    })
                    ->assertInputValue('search[user_id]', $user->present()->name)
                    ->type('search[room_id]', $room->name)
                    ->whenAvailable('.results', function ($results) use ($room) {
                        $results->click('.results-item');
                    })
                    ->assertInputValue('search[room_id]', $room->name . ' - ' . $room->site->name . ', ' . $room->site->location->town)
                    ->click('input[name=start_date]')
                    ->waitForText(date('F Y'))
                    ->clear('start_date')
                    ->type('start_date', $date->addDay()->format('d/m/Y'))
                    ->click('input[name=start_date]')
                    ->waitForText(date('F Y'))
                    ->clear('end_date')
                    ->type('end_date', $date->addDay()->format('d/m/Y'))
                    ->select('start_time', '08:30')
                    ->select('end_time', '16:30')
                    ->press('Save')
                    ->assertPathIs('/classroom/timetable')
                    ->waitForText($timetable->course->name)
                    ->assertSee($timetable->course->name);
        });
    }

    /** @test */
    public function it_displays_errors_when_required_fields_are_missing_from_a_submission()
    {
        $this->browse(function ($browser) {
            $browser->loginAs($this->admin('classroomAdmin'))
                    ->visit('classroom/timetable')
                    ->clickLink('Add')
                    ->assertSee('Create')
                    ->press('Save')
                    ->assertPathIs('/classroom/timetable/create')
                    ->assertSee('Whoops');
        });
    }

    /** @test */
    public function it_returns_an_error_when_a_course_end_date_is_prior_to_the_start_date()
    {
        $timetable = $this->make(Timetable::class, 1);
        $room = $this->rooms();
        $user = $this->userWithDepartment()->first();
        $this->browse(function ($browser) use ($timetable, $room, $user) {
            $date = Carbon::now();
            $browser->loginAs($this->admin('classroomAdmin'))
                    ->visit('classroom/timetable')
                    ->clickLink('Add')
                    ->assertSee('Create')
                    ->select('course_id', "$timetable->course_id")
                    ->type('search[user_id]', $user->first_name)
                    ->whenAvailable('.results', function ($results) {
                        $results->click('.results-item');
                    })
                    ->waitUntilMissing('.results')
                    ->assertInputValue('search[user_id]', $user->present()->name)
                    ->type('search[room_id]', $room->name)
                    ->whenAvailable('.results', function ($results) {
                        $results->click('.results-item');
                    })
                    ->waitUntilMissing('.results')
                    ->assertInputValue('search[room_id]', $room->name . ' - ' . $room->site->name . ', ' . $room->site->location->town)
                    ->click('input[name=start_date]')
                    ->waitForText(date('F Y'))
                    ->clear('start_date')
                    ->type('start_date', $date->addDay()->format('d/m/Y'))
                    ->click('input[name=start_date]')
                    ->waitForText(date('F Y'))
                    ->clear('end_date')
                    ->type('end_date', $date->subDays(10)->format('d/m/Y'))
                    ->select('start_time', '08:30')
                    ->select('end_time', '16:30')
                    ->press('Save')
                    ->assertPathIs('/classroom/timetable/create')
                    ->assertSee('Whoops');
        });
    }
}
