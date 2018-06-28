<?php

namespace App\Forum;

use App\UserManager\Users\User as BaseUser;

class User extends BaseUser
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function channels()
    {
        return $this->belongsToMany(Channel::class, 'forum_channel_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function threads()
    {
        return $this->belongsToMany(Thread::class, 'forum_thread_user');
    }

    /**
     * @param $type
     * @return array
     */
    public function subscribeTo($type)
    {
        return $this->subscription($type)->attach($type);
    }

    /**
     * @param $type
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    private function subscription($type)
    {
        return $type instanceof Thread ? $this->threads() : $this->channels();
    }

    /**
     * @param Thread $type
     * @return int
     */
    public function unSubscribeFrom($type)
    {
        return $this->subscription($type)->detach($type);
    }

    /**
     * @param Thread $type
     * @return bool
     */
    public function isSubscribedTo($type)
    {
        $field = strtolower(collect(explode('\\', get_class($type)))->last()) . '_id';
        
        return $this->subscription($type)->where($field, $type->id)->exists();
    }
}
