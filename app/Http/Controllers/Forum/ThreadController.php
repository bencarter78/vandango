<?php

namespace App\Http\Controllers\Forum;

use App\Forum\Thread;
use App\Forum\Channel;
use App\Forum\Filters\ThreadFilters;
use App\Forum\Trending;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ThreadController extends Controller
{
    /**
     * @param Channel       $channel
     * @param ThreadFilters $filters
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Channel $channel, ThreadFilters $filters)
    {
        return view('forum.threads.index', [
            'channel' => $channel,
            'threads' => $this->getThreads($channel, $filters),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('forum.threads.create', ['channels' => Channel::orderBy('name')->get()]);
    }

    /**
     * @param Thread   $thread
     * @param Trending $trending
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Thread $thread, Trending $trending)
    {
        $trending->push($thread);

        $thread->visited();

        return view('forum.threads.show', ['thread' => $thread->load('creator', 'channel')]);
    }

    /**
     * @param Channel       $channel
     * @param ThreadFilters $filters
     * @return mixed
     */
    private function getThreads(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::latest('updated_at')->with('channel')->filter($filters);

        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

        return $threads->paginate(config('vandango.forum.pagination.perPage'));
    }
}
