<?php

namespace Tests\Unit\Forum;

use App\Forum\User;
use Tests\TestCase;
use App\Forum\Thread;
use App\Events\Forum\ThreadWasPublished;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group forum
 */
class ThreadTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function the_excerpt_displays_the_first_100_characters_of_the_body()
    {
        $length = 50;
        $thread = factory(Thread::class)->create();

        $this->assertEquals($length, strlen($thread->excerpt($length)));
    }

    /** @test */
    public function it_fires_an_event_when_a_new_thread_is_created()
    {
        $this->expectsEvents(ThreadWasPublished::class);

        factory(Thread::class)->create();
    }

    /** @test */
    public function the_thread_creator_is_automatically_subscribed_to_the_thread()
    {
        $this->expectsEvents(ThreadWasPublished::class);

        $thread = factory(Thread::class)->create();

        $this->assertTrue($thread->creator->isSubscribedTo($thread));
    }

    /** @test */
    public function it_returns_all_users_subscribed_to_a_thread()
    {
        $thread = factory(Thread::class)->create();
        $userA = factory(User::class)->create();
        $userB = factory(User::class)->create();

        $this->assertCount(1, $thread->subscribers); // Thread creator

        $userA->subscribeTo($thread);
        $userB->subscribeTo($thread);

        $this->assertCount(3, $thread->fresh()->subscribers);
    }
}
