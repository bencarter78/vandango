<?php

namespace Tests\Feature\Blink;

use Tests\TestCase;
use App\Blink\Models\User;
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
    public function it_displays_the_page_to_create_a_new_course()
    {
        $response = $this->actingAs($this->lineManager())
                         ->get(route('blink.courses.create'));

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function standard_users_cannot_see_the_create_course_page()
    {
        $response = $this->actingAs(factory(User::class)->create())
                         ->get(route('blink.courses.create'));

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function it_displays_the_course_pricing_page()
    {
        $course = factory(Course::class)->create();

        $response = $this->actingAs(factory(User::class)->create())
                         ->get(route('blink.courses.show', $course->id));

        $response->assertStatus(Response::HTTP_OK);
        $this->assertTrue($response->data('course')->is($course));
    }

    /** @test */
    public function standard_users_cannot_see_the_edit_course_page()
    {
        $course = factory(Course::class)->create();

        $response = $this->actingAs(factory(User::class)->create())
                         ->get(route('blink.courses.edit', $course->id));

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function it_displays_the_page_to_edit_a_course()
    {
        $course = factory(Course::class)->create();

        $response = $this->actingAs($this->lineManager())
                         ->get(route('blink.courses.edit', $course->id));

        $response->assertStatus(Response::HTTP_OK);
        $this->assertTrue($response->data('course')->is($course));
    }
}
