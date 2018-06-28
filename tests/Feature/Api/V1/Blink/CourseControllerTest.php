<?php

namespace Tests\Feature\Api\V1\Blink;

use App\Events\Blink\CoursePriceListWasUpdated;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use App\Blink\Models\Course;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class CourseControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_all_courses()
    {
        $courseA = factory(Course::class)->create();
        $courseB = factory(Course::class)->create();
        $courseC = factory(Course::class)->create();

        $response = $this->json('GET', route('api.blink.courses.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->data('data')->assertContains($courseA);
        $response->data('data')->assertContains($courseB);
        $response->data('data')->assertContains($courseC);
    }

    /** @test */
    public function it_stores_a_new_course()
    {
        Event::fake();

        $course = factory(Course::class)->make();

        $response = $this->json('POST', route('api.blink.courses.store'), array_merge($course->toArray(), [
            'framework_expires_on' => $course->framework_expires_on->format('d/m/Y'),
        ]));

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertEquals(1, Course::count());
        Event::assertDispatched(CoursePriceListWasUpdated::class);
    }

    /** @test */
    public function it_updates_an_existing_course()
    {
        Event::fake();

        $course = factory(Course::class)->create(['title' => 'Demo Title']);

        $response = $this->json('PUT', route('api.blink.courses.update', $course->id), array_merge($course->toArray(), [
            'title' => 'Example Title',
            'framework_expires_on' => $course->framework_expires_on->format('d/m/Y'),
        ]));

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals(1, Course::count());
        $this->assertEquals('Example Title', $course->fresh()->title);
        Event::assertDispatched(CoursePriceListWasUpdated::class);
    }

    /** @test */
    public function an_expiry_date_is_required_if_framework_is_selected()
    {
        $course = factory(Course::class)->make(['type' => 'Framework', 'framework_expires_on' => null]);

        $response = $this->json('POST', route('api.blink.courses.store'), $course->toArray());

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertEquals(0, Course::count());
    }
}
