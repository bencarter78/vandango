<?php

namespace Tests\Http\UserManager;

use Tests\BrowserKitTest;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group usermanager
 */
class DashboardControllerTest extends BrowserKitTest
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
        parent::dbSeed();
    }

    /** @test */
    function it_lists_newly_added_users()
    {
        $user = $this->user();
        $user->meta->start_date = date('Y-m-d');
        $user->meta->save();
        $this->actingAs($this->user())
             ->visit('/usermanager/dashboard')
             ->see('Recruits')
             ->see($user->present()->name)
             ->see(date('M j'));
    }

    /** @test */
    function it_lists_recent_leavers()
    {
        $leaver = $this->user();
        $leaver->meta->start_date = '2000-01-01';
        $leaver->meta->save();
        $leaver->delete();
        $this->actingAs($this->user())
             ->visit('/usermanager/dashboard')
             ->see('Leavers')
             ->see($leaver->present()->name)
             ->see(date('M j'));
    }

    /** @test */
    function it_lists_users_with_no_job_role()
    {
        $user = $this->user([
            'departments' => $this->departments()->id,
            'sectors' => $this->sectors()->id,
        ]);

        $this->actingAs($this->user())
             ->visit('/usermanager/dashboard')
             ->see('Unassigned Role')
             ->see($user->present()->name);
    }

}
