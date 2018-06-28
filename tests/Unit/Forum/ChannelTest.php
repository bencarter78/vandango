<?php

namespace Tests\Unit\Forum;

use Tests\TestCase;
use App\Forum\Channel;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group forum
 */
class ChannelTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_updates_the_slug_when_a_channel_is_created()
    {
        $channel = Channel::create(['name' => 'Example Channel']);

        $this->assertEquals('example-channel', $channel->slug);
    }

    /** @test */
    public function it_assigns_a_color_to_the_channel_when_a_channel_is_created()
    {
        $channel = factory(Channel::class)->create();

        $this->assertNotNull($channel->color);
    }
}
