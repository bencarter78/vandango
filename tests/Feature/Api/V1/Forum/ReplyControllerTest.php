<?php

namespace Tests\Feature\Api\V1\Forum;

use Tests\TestCase;
use App\Forum\User;
use App\Forum\Reply;
use App\Forum\Thread;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group forum
 */
class ReplyControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function users_can_reply_to_a_thread()
    {
        Mail::fake();

        $user = factory(User::class)->create();
        $thread = factory(Thread::class)->create();

        $response = $this->json('POST', route('api.forum.threads.replies.store', $thread->slug), [
            'user_id' => $user->id,
            'body' => 'This is an example reply.',
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertInstanceOf(Reply::class, $response->data('data'));
        $this->assertCount(1, $thread->replies);
    }

    /** @test */
    public function it_increments_the_thread_count_when_a_reply_is_created()
    {
        Mail::fake();

        $user = factory(User::class)->create();
        $thread = factory(Thread::class)->create();

        $response = $this->json('POST', route('api.forum.threads.replies.store', $thread->slug), [
            'user_id' => $user->id,
            'body' => 'This is an example reply.',
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertEquals(1, $thread->fresh()->replies_count);
    }

    /** @test */
    public function the_user_id_is_required()
    {
        $thread = factory(Thread::class)->create();

        $response = $this->json('POST', route('api.forum.threads.replies.store', $thread->slug), [
            'body' => 'This is an example reply.',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function the_body_is_required()
    {
        $thread = factory(Thread::class)->create();

        $response = $this->json('POST', route('api.forum.threads.replies.store', $thread->slug), [
            'channel_id' => $thread->channel_id,
            'user_id' => 1,
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function it_returns_all_thread_replies_paginated()
    {
        Mail::fake();

        $thread = factory(Thread::class)->create();
        $replies = factory(Reply::class)->create(['thread_id' => $thread->id]);

        $response = $this->json('get', route('api.forum.threads.replies.index', $thread->slug));

        $response->assertStatus(Response::HTTP_OK);
        $response->data('data')->assertContains($replies);
    }
}
