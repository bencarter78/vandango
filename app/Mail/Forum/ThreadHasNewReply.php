<?php

namespace App\Mail\Forum;

use App\Forum\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ThreadHasNewReply extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var Reply
     */
    public $reply;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('VanDango Forum: New reply to ' . $this->reply->thread->title)
            ->view('emails.forum.threads.reply-received');
    }
}
