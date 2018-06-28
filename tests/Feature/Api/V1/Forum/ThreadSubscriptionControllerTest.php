<?php

namespace Tests\Feature\Api\V1\Forum;

use Tests\TestCase;
use App\Forum\User;
use App\Forum\Thread;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group forum
 */
class ThreadSubscriptionControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_subscribes_a_user_to_a_thread()
    {
        $thread = factory(Thread::class)->create();
        $user = factory(User::class)->create();

        $response = $this->json('POST', route('api.forum.threads.subscriptions.store', $thread->slug), [
            'user_id' => $user->id,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertTrue($user->isSubscribedTo($thread));
        $this->assertCount(1, $user->threads);
    }

    /** @test */
    public function it_unsubscribes_a_user_from_a_thread()
    {
        $thread = factory(Thread::class)->create();
        $user = factory(User::class)->create();
        $user->subscribeTo($thread);

        $response = $this->json('DELETE', route('api.forum.threads.subscriptions.destroy', $thread->slug), [
            'user_id' => $user->id,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertFalse($user->isSubscribedTo($thread));
        $this->assertCount(0, $user->threads);
    }

    /** @test */
    public function a_user_can_not_unsubscribe_to_a_thread_if_not_subscribed()
    {
        $thread = factory(Thread::class)->create();
        $user = factory(User::class)->create();

        $response = $this->json('DELETE', route('api.forum.threads.subscriptions.destroy', $thread->slug), [
            'user_id' => $user->id,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertFalse($user->isSubscribedTo($thread));
        $this->assertCount(0, $user->threads);
    }
}
