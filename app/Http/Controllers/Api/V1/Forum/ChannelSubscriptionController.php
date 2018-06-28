<?php

namespace App\Http\Controllers\Api\V1\Forum;

use App\Forum\User;
use App\Forum\Channel;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ChannelSubscriptionController extends Controller
{
    /**
     * @param Channel $channel
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Channel $channel)
    {
        User::findOrFail(request('user_id'))->subscribeTo($channel);

        return $this->response([], Response::HTTP_CREATED);
    }

    /**
     * @param Channel $channel
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Channel $channel)
    {
        User::findOrFail(request('user_id'))->unsubscribeFrom($channel);

        return $this->response([]);
    }
}
