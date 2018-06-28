<?php

namespace Tests\Unit\Listeners\Forum;

use Tests\TestCase;
use App\Forum\User;
use App\Forum\Reply;
use Illuminate\Support\Facades\Mail;
use App\Events\Forum\ThreadHasNewReply;
use App\Mail\Forum\ThreadHasNewReply as Mailer;
use App\Listeners\Forum\NotifyThreadSubscribers;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group forum
 */
class NotifyThreadSubscribersTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_notifies_all_thread_subscribers_when_a_new_reply_is_left()
    {
        Mail::fake();

        $reply = factory(Reply::class)->create();
        $users = factory(User::class, 3)->create();
        $users->each->subscribeTo($reply->thread);
        $event = $this->mock(ThreadHasNewReply::class);
        $event->reply = $reply;

        (new NotifyThreadSubscribers())->handle($event);

        Mail::assertSent(Mailer::class, function ($mail) use ($users) {
            return $mail->hasTo($users->pluck('email'));
        });
    }

    /** @test */
    public function it_does_not_notify_the_user_if_they_are_the_reply_owner()
    {
        Mail::fake();

        $user = factory(User::class)->create();
        $reply = factory(Reply::class)->create(['user_id' => $user->id]);
        $user->subscribeTo($reply->thread);

        event(new ThreadHasNewReply($reply));

        Mail::assertSent(Mailer::class, function ($mail) use ($user) {
            return ! $mail->hasTo($user->email);
        });
    }
}
