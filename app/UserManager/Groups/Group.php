<?php

namespace App\UserManager\Groups;

use App\Core\BaseModel;
use App\UserManager\Users\User;

class Group extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'slug'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_groups');
    }

}
