<?php

namespace Tests\Feature\Cpd;

use App\Cpd\User;
use Tests\TestCase;
use App\Cpd\Activity;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group cpd
 */
class ActivityControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_displays_all_cpd_activities_for_the_logged_in_user()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('cpd.activities.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('cpd.dashboard-user');
    }

    /** @test */
    public function it_displays_the_form_to_create_an_activity()
    {
        $response = $this->actingAs($this->user())->get(route('cpd.activities.create'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('cpd.activities.create');
    }

    /** @test */
    public function it_displays_the_form_to_edit_an_activity()
    {
        $response = $this->actingAs($this->user())->get(route('cpd.activities.edit', factory(Activity::class)->create()->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('cpd.activities.edit');
    }
}
