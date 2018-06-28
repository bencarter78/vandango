<?php

namespace App\UserManager\Roles;

use App\Core\BaseModel;
use App\UserManager\Users\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends BaseModel
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['job_role'];

    /**
     * @var string
     */
    protected $table = 'data_job_roles';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles');
    }

} 