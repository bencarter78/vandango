<?php

namespace App\Forum;

use Illuminate\Support\Facades\Cache;

class Trending
{
    /**
     * @var string
     */
    private $cacheKey = 'trending_threads';

    /**
     * Fetch all trending threads.
     *
     * @return array
     */
    public function get()
    {
        return Cache::get($this->cacheKey, collect())
                    ->sortByDesc('score')
                    ->slice(0, 5)
                    ->values();
    }

    /**
     * Push a new thread to the trending list.
     *
     * @param Thread $thread
     * @param int    $increment
     */
    public function push($thread, $increment = 1)
    {
        $trending = Cache::get($this->cacheKey, collect());

        $trending[$thread->id] = (object) [
            'score' => $this->score($thread) + $increment,
            'title' => $thread->title,
            'slug' => $thread->slug,
        ];

        Cache::forever($this->cacheKey, $trending);
    }

    /**
     * Get the trending score of the given thread.
     *
     * @param int
     * @return int
     */
    public function score($thread)
    {
        $trending = Cache::get($this->cacheKey, collect());

        if (! isset($trending[$thread->id])) {
            return 0;
        }

        return $trending[$thread->id]->score;
    }

    /**
     * Reset all trending threads.
     */
    public function reset()
    {
        return Cache::forget($this->cacheKey);
    }
}
