<?php

namespace App\Listeners\Forum;

use App\Forum\Thread;
use Illuminate\Support\Facades\Mail;
use App\Events\Forum\ThreadWasPublished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Forum\ThreadWasPublished as Mailer;

class NotifyChannelSubscribers implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  ThreadWasPublished $event
     * @return void
     */
    public function handle(ThreadWasPublished $event)
    {
        $subcribers = $this->subscribers($event->thread);

        if ($subcribers->count() > 0) {
            Mail::to($event->thread->channel->subscribers)->send(new Mailer($event->thread));
        }
    }

    /**
     * @param Thread $thread
     * @return mixed
     */
    private function subscribers(Thread $thread)
    {
        return $thread->channel->subscribers->reject(function ($user) use ($thread) {
            return $user->is($thread->creator);
        });
    }
}
