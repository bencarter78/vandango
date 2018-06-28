<?php

namespace Tests\Feature\Api\V1\Forum;

use Tests\TestCase;
use App\Forum\Channel;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group forum
 */
class ChannelControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_creates_a_new_channel()
    {
        $channel = factory(Channel::class)->make(['name' => 'Example Channel']);

        $response = $this->json('POST', route('api.forum.channels.store'), $channel->toArray());

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertEquals('Example Channel', $response->data('data')->name);
    }

    /** @test */
    public function a_name_is_required_for_a_channel()
    {
        $response = $this->json('POST', route('api.forum.channels.store'), []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function channel_names_are_unique()
    {
        factory(Channel::class)->create(['name' => 'Example Channel']);
        $channel = factory(Channel::class)->make(['name' => 'Example Channel']);

        $response = $this->json('POST', route('api.forum.channels.store'), $channel->toArray());

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function it_updates_a_channel()
    {
        $channel = factory(Channel::class)->create(['name' => 'Example Channel']);

        $response = $this->json('PATCH', route('api.forum.channels.update', $channel->slug), [
            'name' => 'Example Renamed Channel',
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertEquals('Example Renamed Channel', $response->data('data')->name);
    }
}
