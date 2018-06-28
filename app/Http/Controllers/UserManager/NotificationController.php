<?php

namespace App\Http\Controllers\UserManager;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('usermanager.notification.index');
    }
}
