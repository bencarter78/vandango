<?php

namespace App\UserManager\Departments;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends BaseModel
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['department', 'manager_id', 'ad_id'];

    /**
     * @var string
     */
    protected $table = 'data_departments';

    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany('App\UserManager\Users\User', 'users_departments');
    }

    /**
     * @return mixed
     */
    public function manager()
    {
        return $this->belongsTo('App\UserManager\Users\User', 'manager_id');
    }

    /**
     * @return mixed
     */
    public function ad()
    {
        return $this->belongsTo('App\UserManager\Users\User', 'ad_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sectors()
    {
        return $this->hasMany('App\UserManager\Sectors\Sector');
    }

    /**
     * @return mixed
     */
    public function director()
    {
        return $this->ad();
    }

}
