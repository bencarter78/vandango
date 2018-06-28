<?php

namespace App\Forum;

use App\Forum\Filters\ThreadFilters;
use Illuminate\Database\Eloquent\Model;
use App\Events\Forum\ThreadWasPublished;

class Thread extends Model
{
    /**
     * @var string
     */
    protected $table = 'forum_threads';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($thread) {
            $thread->creator->subscribeTo($thread);

            event(new ThreadWasPublished($thread));
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'forum_thread_user');
    }

    /**
     * @param int $length
     * @return bool|string
     */
    public function excerpt($length = 100)
    {
        return substr(strip_tags($this->body), 0, $length);
    }

    /**
     * Get the route key name.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Set the title of the thread.
     *
     * @param string $title
     */
    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = str_slug($title);
    }

    /**
     * Apply all relevant thread filters.
     *
     * @param  Builder       $query
     * @param  ThreadFilters $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, ThreadFilters $filters)
    {
        return $filters->apply($query);
    }

    /**
     * @return bool
     */
    public function visited()
    {
        $this->timestamps = false;

        return $this->update(['views' => $this->views + 1]);
    }
}
