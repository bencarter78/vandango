<?php

namespace App\Policies\Blink;

use App\Blink\Models\Enquiry;
use App\UserManager\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnquiryPolicy
{
    /**
     * @param User    $user
     * @param Enquiry $enquiry
     * @return bool
     */
    public function updateOwner(User $user, Enquiry $enquiry)
    {
        return $enquiry->owners->count() > 0
            ? $user->hasAccess('blinkAdmin') || $user->id == $enquiry->owners->last()->id || $user->isManagerOf(User::find($enquiry->owners->last()->id))
            : true;
    }
}
