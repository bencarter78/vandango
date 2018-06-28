<?php

namespace Tests\Feature\Api\V1\Forum;

use Tests\TestCase;
use App\Forum\Thread;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group forum
 */
class ThreadControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_creates_a_new_thread()
    {
        $thread = factory(Thread::class)->make(['title' => 'My Example Title']);

        $response = $this->json('POST', route('api.forum.threads.store'), $thread->toArray());

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertEquals('My Example Title', $response->data('data')->title);
    }
}
