<?php

namespace Tests\Unit\Forum;

use Tests\TestCase;
use App\Forum\Reply;
use App\Events\Forum\ThreadHasNewReply;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group forum
 */
class ReplyTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
    	parent::setUp();
    	$this->dbSetUp();
    }

    /** @test */
    public function it_fires_an_event_when_a_reply_is_created()
    {
        $this->expectsEvents(ThreadHasNewReply::class);

        factory(Reply::class)->create();
    }
}
