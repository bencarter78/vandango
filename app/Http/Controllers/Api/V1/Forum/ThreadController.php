<?php

namespace App\Http\Controllers\Api\V1\Forum;

use App\Forum\Thread;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ThreadController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $thread = Thread::create(request()->only('channel_id', 'user_id', 'title', 'body'));

        return $this->response($thread, Response::HTTP_CREATED);
    }
}
