<?php

namespace App\Mail\Forum;

use App\Forum\Thread;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ThreadWasPublished extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var Thread
     */
    public $thread;

    /**
     * Create a new message instance.
     *
     * @param Thread $thread
     */
    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('VanDango Forum: New thread posted by ' . $this->thread->creator->fullName)
            ->view('emails.forum.channels.new-thread');
    }
}
