<?php

namespace App\Judi\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Process extends BaseModel
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'judi_processes';

    /**
     * @var array
     */
    protected $fillable = ['name', 'trigger_week'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    /**
     * @return mixed
     */
    public function reports()
    {
        return $this->belongsToMany(Report::class, 'judi_process_report');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'judi_role_process', 'process_id', 'role_id');
    }

    /**
     * The assessors eligible to PA a Process
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'judi_process_user', 'process_id', 'user_id');
    }

    /**
     * More understandable domain language
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function assessors()
    {
        return $this->users->filter(function($user) {
            return $user->isPa();
        });
    }
}