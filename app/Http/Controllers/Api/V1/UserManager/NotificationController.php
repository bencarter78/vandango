<?php

namespace App\Http\Controllers\Api\V1\UserManager;

use App\UserManager\Users\User;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(User $user)
    {
        return $this->response($user->notifications);
    }

    /**
     * @param Notification $notification
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DatabaseNotification $notification)
    {
        $notification->markAsRead();

        return $this->response($notification);
    }
}
