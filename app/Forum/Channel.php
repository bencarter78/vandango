<?php

namespace App\Forum;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    /**
     * @var string
     */
    protected $table = 'forum_channels';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the route key name for Laravel.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Set the name of the channel.
     *
     * @param string $name
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = str_slug($name);
        $this->attributes['color'] = sprintf("#%06X", mt_rand(0, 0xFFFFFF));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'forum_channel_user');
    }
}
