<?php

namespace Tests\Browser\Blink\Enquiries;

use Tests\DuskTestCase;
use Tests\Traits\Blink;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group blink
 */
class CreateTest extends DuskTestCase
{
    use DatabaseMigrations, Blink;

    /** @test */
    public function it_adds_an_enquiry_for_a_new_organisation()
    {
        $this->browse(function ($browser) {
//            $date = Carbon::now();
            $browser->loginAs($this->user())
                    ->visit('blink/enquiries')
                    ->clickLink('Add')
                    ->assertSee('Create')
//                    ->select('course_id', "$timetable->course_id")
//                    ->type('search[user_id]', $user->first_name)
//                    ->pause(10000)
//                    ->whenAvailable('.results', function ($results) use ($user) {
//                        $results->click('.results-item');
//                    })
//                    ->assertInputValue('search[user_id]', $user->present()->name)
//                    ->type('search[room_id]', $room->name)
//                    ->whenAvailable('.results', function ($results) use ($room) {
//                        $results->click('.results-item');
//                    })
//                    ->assertInputValue('search[room_id]', $room->name . ' - ' . $room->site->name . ', ' . $room->site->location->town)
//                    ->click('input[name=start_date]')
//                    ->waitForText(date('F Y'))
//                    ->clear('start_date')
//                    ->type('start_date', $date->addDay()->format('d/m/Y'))
//                    ->click('input[name=start_date]')
//                    ->waitForText(date('F Y'))
//                    ->clear('end_date')
//                    ->type('end_date', $date->addDay()->format('d/m/Y'))
//                    ->select('start_time', '08:30')
//                    ->select('end_time', '16:30')
//                    ->press('Save')
//                    ->assertPathIs('/classroom/timetable')
//                    ->waitForText($timetable->course->name)
                    ->assertSee('success');
        });
    }
}
