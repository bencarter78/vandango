<?php

namespace Tests\Feature\Forum;

use Tests\TestCase;
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
    public function it_displays_the_form_to_create_a_channel()
    {
        $response = $this->actingAs($this->user())->json('GET', route('forum.channels.create'));

        $response->assertStatus(Response::HTTP_OK);
    }
}
