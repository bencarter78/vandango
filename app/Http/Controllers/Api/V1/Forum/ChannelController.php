<?php

namespace App\Http\Controllers\Api\V1\Forum;

use App\Forum\Channel;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ChannelController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => ['required', 'unique:forum_channels'],
        ], [
            'name.required' => 'Please give a name for the title',
            'name.unique' => 'That channel name has already been taken, please try again',
        ]);

        $channel = Channel::create(request()->only('name'));

        return $this->response($channel, Response::HTTP_CREATED);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Channel $channel)
    {
        $this->validate(request(), [
            'name' => ['required', Rule::unique('users')->ignore($channel->id),],
        ], [
            'name.required' => 'Please give a name for the title',
            'name.unique' => 'That channel name has already been taken, please try again',
        ]);

        $channel->update(request()->only('name'));

        return $this->response($channel, Response::HTTP_CREATED);
    }
}
