<?php

namespace Tests\Feature\Api\V1\Cpd;

use App\Cpd\User;
use Carbon\Carbon;
use Tests\TestCase;
use App\Cpd\Activity;
use App\Cpd\Organisation;
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

    private function requestData()
    {
        return [
            'title' => 'Example Title',
            'organisation' => 'Example Training',
            'starts_on' => Carbon::now()->format('d/m/Y'),
            'ends_on' => Carbon::now()->format('d/m/Y'),
            'completed_on' => Carbon::now()->format('d/m/Y'),
            'total_hours' => 123,
            'grade_id' => 123,
            'reflection' => 'Example reflection',
            'path' => 'path/to/my/file.jpg',
        ];
    }

    /** @test */
    public function it_returns_all_cpd_activity_for_a_given_user()
    {
        $user = factory(User::class)->create();
        $activities = factory(Activity::class, 3)->create(['user_id' => $user->id]);
        $otherUserActivitiy = factory(Activity::class)->create();

        $response = $this->json('GET', route('api.cpd.activities.index'), ['user_id' => $user->id]);

        $response->assertStatus(Response::HTTP_OK);
        $response->data('data')->assertNotContains($otherUserActivitiy);
        $response->data('data')->assertEquals($activities);
    }

    /** @test */
    public function it_returns_a_given_cpd_activity()
    {
        $activity = factory(Activity::class)->create();

        $response = $this->json('GET', route('api.cpd.activities.show', $activity->id));

        $response->assertStatus(Response::HTTP_OK);
        $this->assertTrue($response->data('data')->is($activity));
    }

    /** @test */
    public function it_stores_a_new_cpd_activity()
    {
        $user = factory(User::class)->create();

        $response = $this->json('POST', route('api.cpd.activities.store'), array_merge($this->requestData(), [
            'user_id' => $user->id,
        ]));

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals('Example Title', $response->data('data')->title);
        $this->assertCount(1, Activity::get());
        $this->assertCount(1, $user->activities);
        $this->assertEquals(Activity::first()->grade_id, 123);
        $this->assertEquals(Activity::first()->reflection, 'Example reflection');
        $this->assertEquals(Activity::first()->path, 'path/to/my/file.jpg');
    }

    /** @test */
    public function a_new_organisation_is_created_when_the_deliverer_id_is_null()
    {
        $response = $this->json('POST', route('api.cpd.activities.store'), array_merge($this->requestData(), [
            'user_id' => factory(User::class)->create()->id,
        ]));

        $response->assertStatus(Response::HTTP_OK);
        $this->assertCount(1, Organisation::get());
    }

    /** @test */
    public function it_updates_a_cpd_activity()
    {
        $activity = factory(Activity::class)->create();

        $response = $this->json('PATCH', route('api.cpd.activities.update', $activity->id), array_merge($this->requestData(), [
            'user_id' => $activity->user_id,
        ]));

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals('Example Title', $response->data('data')->title);
        $this->assertCount(1, Activity::get());
    }

    /** @test */
    public function a_title_is_required()
    {
        $activity = factory(Activity::class)->create();

        $response = $this->json('PATCH', route('api.cpd.activities.update', $activity->id));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertHasError('title');
    }

    /** @test */
    public function a_start_date_is_required()
    {
        $activity = factory(Activity::class)->create();

        $response = $this->json('PATCH', route('api.cpd.activities.update', $activity->id));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertHasError('starts_on');
    }

    /** @test */
    public function an_end_date_is_required()
    {
        $activity = factory(Activity::class)->create();

        $response = $this->json('PATCH', route('api.cpd.activities.update', $activity->id));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertHasError('ends_on');
    }

    /** @test */
    public function an_organisation_is_required()
    {
        $activity = factory(Activity::class)->create();

        $response = $this->json('PATCH', route('api.cpd.activities.update', $activity->id));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertHasError('organisation');
    }

    /** @test */
    public function the_total_hours_field_is_required_when_a_completed_date_is_present()
    {
        $activity = factory(Activity::class)->create();

        $response = $this->json('PATCH', route('api.cpd.activities.update', $activity->id), [
            'completed_on' => Carbon::now()->format('d/m/Y'),
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertHasError('total_hours');
    }

    /** @test */
    public function a_grade_is_required_when_a_completed_date_is_present()
    {
        $activity = factory(Activity::class)->create();

        $response = $this->json('PATCH', route('api.cpd.activities.update', $activity->id), [
            'completed_on' => Carbon::now()->format('d/m/Y'),
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertHasError('grade_id');
    }

    /** @test */
    public function a_reflection_is_required_when_a_completed_date_is_present()
    {
        $activity = factory(Activity::class)->create();

        $response = $this->json('PATCH', route('api.cpd.activities.update', $activity->id), [
            'completed_on' => Carbon::now()->format('d/m/Y'),
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertHasError('reflection');
    }

    /** @test */
    public function dates_must_be_formatted_d_m_Y()
    {
        $activity = factory(Activity::class)->create();

        $response = $this->json('PATCH', route('api.cpd.activities.update', $activity->id), [
            'starts_on' => Carbon::now()->format('Y-m-d'),
            'ends_on' => Carbon::now()->format('Y-m-d'),
            'completed_on' => Carbon::now()->format('Y-m-d'),
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertHasError('starts_on');
        $response->assertHasError('ends_on');
        $response->assertHasError('completed_on');
    }

    /** @test */
    public function a_user_can_delete_their_activity()
    {
        $activity = factory(Activity::class)->create();

        $response = $this->json('DELETE', route('api.cpd.activities.destroy', $activity->id), [
            'user_id' => $activity->user_id,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertCount(0, Activity::get());
        $this->assertCount(1, Activity::withTrashed()->get());
    }

    /** @test */
    public function a_user_cannot_delete_anothers_activity()
    {
        $user = factory(User::class)->create();
        $activity = factory(Activity::class)->create();

        $response = $this->json('DELETE', route('api.cpd.activities.destroy', $activity->id), [
            'user_id' => $user->id,
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $this->assertCount(1, Activity::get());
    }
}
