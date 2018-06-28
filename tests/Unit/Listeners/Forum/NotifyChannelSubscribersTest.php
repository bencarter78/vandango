<?php

namespace Tests\Unit\Listeners\Forum;

use Tests\TestCase;
use App\Forum\User;
use App\Forum\Thread;
use Illuminate\Support\Facades\Mail;
use App\Events\Forum\ThreadWasPublished;
use App\Mail\Forum\ThreadWasPublished as Mailer;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group forum
 */
class NotifyChannelSubscribersTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_notifies_all_channel_subscribers_when_a_new_thread_is_created()
    {
        Mail::fake();

        $thread = factory(Thread::class)->create();
        $users = factory(User::class, 3)->create();
        $users->each->subscribeTo($thread->channel);

        event(new ThreadWasPublished($thread));

        Mail::assertSent(Mailer::class, function ($mail) use ($users) {
            return $mail->hasTo($users->pluck('email'));
        });
    }

    /** @test */
    public function it_does_not_notify_the_user_if_they_are_the_reply_owner()
    {
        Mail::fake();

        $user = factory(User::class)->create();
        $thread = factory(Thread::class)->create(['user_id' => $user->id]);
        $user->subscribeTo($thread->channel);

        event(new ThreadWasPublished($thread));

        Mail::assertNotSent(Mailer::class);
    }
}
