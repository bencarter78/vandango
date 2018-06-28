<?php

namespace Tests\Http\UserManager;

use Tests\BrowserKitTest;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group usermanager
 */
class RoleControllerTest extends BrowserKitTest
{
    use DatabaseMigrations;

    /** @test */
    function it_shows_the_form_to_create_a_role()
    {
        $this->actingAs($this->superuser())
             ->visit('/usermanager/roles/create')
             ->see('Create Job Role');
    }

    /** @test */
    function it_does_not_allow_superusers_to_see_the_form()
    {
        $this->actingAs($this->user())
             ->visit('/usermanager/roles/create')
             ->dontSee('Create Job Role');
    }

    /** @test */
    function it_submits_the_form()
    {
        $this->actingAs($this->superuser())
             ->visit('/usermanager/roles/create')
             ->type('My New Role', 'job_role')
             ->press('Create')
             ->seePageIs('usermanager/roles')
             ->see('My New Role');
    }

}
