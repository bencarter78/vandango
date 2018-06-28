<?php

namespace App\Listeners\Forum;

use App\Forum\Reply;
use Illuminate\Support\Facades\Mail;
use App\Events\Forum\ThreadHasNewReply;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Forum\ThreadHasNewReply as Mailer;

class NotifyThreadSubscribers implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  ThreadHasNewReply $event
     * @return void
     */
    public function handle(ThreadHasNewReply $event)
    {
        $subcribers = $this->subscribers($event->reply);

        if ($subcribers->count() > 0) {
            Mail::to($this->subscribers($event->reply))->send(new Mailer($event->reply));
        }
    }

    /**
     * @param Reply $reply
     * @return mixed
     */
    private function subscribers(Reply $reply)
    {
        return $reply->thread->subscribers->reject(function ($user) use ($reply) {
            return $user->is($reply->owner);
        });
    }
}
