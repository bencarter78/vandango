<?php

namespace Tests\Http\Judi;

use Tests\Traits\Judi;
use Tests\BrowserKitTest;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group judi
 */
class DashboardControllerTest extends BrowserKitTest
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
        parent::dbSeed();
    }

    /** @test */
    function it_shows_the_filter_form_to_admins()
    {
        $this->actingAs($this->groupUser(['judiAdmin', 'judi']))
             ->visit('judi')
             ->see('Filter Summaries')
             ->see('Date From')
             ->see('Date To')
             ->see('Grade')
             ->see('Sector');
    }

    /** @test */
    function it_does_not_show_the_filter_form_to_PAs()
    {
        $this->actingAs($this->groupUser(['judiPa', 'judi']))
             ->visit('judi')
             ->dontSee('Filter Summaries');
    }

    /** @test */
    function it_does_not_show_the_filter_form_to_Sector_Managers()
    {
        $this->actingAs($this->groupUser(['judiSM', 'judi']))
             ->visit('judi')
             ->dontSee('Filter Summaries');
    }

}