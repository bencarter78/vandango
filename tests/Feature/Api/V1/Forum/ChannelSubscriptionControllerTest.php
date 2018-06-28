<?php

namespace Tests\Feature\Api\V1\Forum;

use Tests\TestCase;
use App\Forum\User;
use App\Forum\Channel;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group forum
 */
class ChannelSubscriptionControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_subscribes_a_user_to_a_channel()
    {
        $channel = factory(Channel::class)->create();
        $user = factory(User::class)->create();

        $response = $this->json('POST', route('api.forum.channels.subscriptions.store', $channel->slug), [
            'user_id' => $user->id,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertTrue($user->isSubscribedTo($channel));
        $this->assertCount(1, $user->channels);
    }

    /** @test */
    public function it_unsubscribes_a_user_from_a_channel()
    {
        $channel = factory(Channel::class)->create();
        $user = factory(User::class)->create();
        $user->subscribeTo($channel);

        $response = $this->json('DELETE', route('api.forum.channels.subscriptions.destroy', $channel->slug), [
            'user_id' => $user->id,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertFalse($user->isSubscribedTo($channel));
        $this->assertCount(0, $user->channels);
    }

    /** @test */
    public function a_user_can_not_unsubscribe_to_a_channel_if_not_subscribed()
    {
        $channel = factory(Channel::class)->create();
        $user = factory(User::class)->create();

        $response = $this->json('DELETE', route('api.forum.channels.subscriptions.destroy', $channel->slug), [
            'user_id' => $user->id,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertFalse($user->isSubscribedTo($channel));
        $this->assertCount(0, $user->channels);
    }
}
