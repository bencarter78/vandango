<?php

namespace App\Http\Controllers\Api\V1\Forum;

use App\Forum\User;
use App\Forum\Thread;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ThreadSubscriptionController extends Controller
{
    /**
     * @param Thread $thread
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Thread $thread)
    {
        User::findOrFail(request('user_id'))->subscribeTo($thread);

        return $this->response([], Response::HTTP_CREATED);
    }

    /**
     * @param Thread $thread
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Thread $thread)
    {
        User::findOrFail(request('user_id'))->unsubscribeFrom($thread);

        return $this->response([]);
    }
}
