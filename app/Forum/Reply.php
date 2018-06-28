<?php

namespace App\Forum;

use App\Events\Forum\ThreadHasNewReply;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    /**
     * @var string
     */
    protected $table = 'forum_replies';

    /**
     * @var array
     */
    protected $with = ['owner'];

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Boot the reply instance.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($reply) {
            $reply->thread->increment('replies_count');
            event(new ThreadHasNewReply($reply));
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
}
