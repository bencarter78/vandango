<?php

namespace App\Http\Controllers\Api\V1\Forum;

use App\Forum\Thread;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends Controller
{
    /**
     * @param Thread $thread
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Thread $thread)
    {
        return $this->response($thread->replies()->paginate(config('vandango.forum.pagination.perPage')));
    }

    /**
     * @param Thread $thread
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Thread $thread)
    {
        $this->validate(request(), [
            'user_id' => 'required',
            'body' => 'required',
        ], [
            'user_id.required' => 'Something has gone wrong. Please log in and try again',
            'body.required' => 'Please enter your question',
        ]);

        $reply = $thread->replies()->create([
            'thread_id' => $thread->id,
            'user_id' => request('user_id'),
            'body' => request('body'),
        ]);

        return $this->response($reply->load('owner'), Response::HTTP_CREATED);
    }
}
