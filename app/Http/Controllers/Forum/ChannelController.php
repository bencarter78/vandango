<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;

class ChannelController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('forum.channels.create');
    }
}
