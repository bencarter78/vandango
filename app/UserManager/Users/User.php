<?php

namespace App\UserManager\Users;

use Auth, Hash;
use Illuminate\Auth\UserTrait;
use App\UserManager\Roles\Role;
use App\UserManager\Groups\Group;
use App\UserManager\Sectors\Sector;
use Illuminate\Notifications\Notifiable;
use Laracasts\Presenter\PresentableTrait;
use App\UserManager\Departments\Department;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use CanResetPassword, SoftDeletes, PresentableTrait, Notifiable;

    /**
     * @var string
     */
    protected $presenter = UserPresenter::class;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $fillable = ['email', 'password', 'username', 'first_name', 'surname', 'activated'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $appends = ['full_name'];

    /**
     * @return mixed
     */
    public function meta()
    {
        return $this->hasOne(UserMeta::class, 'user_id');
    }

    /**
     * @return mixed
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'users_groups', 'user_id', 'group_id');
    }

    /**
     * @return mixed
     */
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'users_departments', 'user_id', 'department_id');
    }

    /**
     * @return mixed
     */
    public function sectors()
    {
        return $this->belongsToMany(Sector::class, 'users_sectors', 'user_id', 'sector_id');
    }

    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id');
    }

    /**
     * @param null $accessType
     * @return bool
     */
    public function hasAccess($accessType = null)
    {
        $groups = $this->groups->pluck('slug')->all();

        return in_array('admin', $groups) || in_array($accessType, $groups);
    }

    /**
     * @param null $role
     * @return bool
     */
    public function hasRole($role = null)
    {
        return in_array($role, $this->roles->pluck('job_role')->all());
    }

    /**
     * @param $sector
     * @return bool
     */
    public function isSectorManager($sector)
    {
        return $this->isDepartmentManager() && $this->hasSector($sector);
    }

    /**
     * @return bool
     */
    public function isDepartmentManager()
    {
        return $this->hasRole(config('vandango.usermanager.departments.manager.name'));
    }

    /**
     * @param null $sectorName
     * @return bool
     */
    public function hasSector($sectorName = null)
    {
        return in_array($sectorName, $this->sectors->pluck('name')->all());
    }

    /**
     * Returns collection of manager IDs
     *
     * @deprecated
     * Should use getManagers() and pull ids from that
     *
     * @return \Illuminate\Support\Collection
     */
    public function getLineManagers()
    {
        $managers = $this->departments->map(function ($department) {
            return $department->manager_id;
        });

        if ($managers->count() == 1 && in_array($this->id, $managers->toArray())) {
            $managers = $this->departments->map(function ($department) {
                return $department->ad_id;
            });
        }

        return $managers;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getManagers()
    {
        $managers = $this->departments->map(function ($department) {
            return $department->manager;
        });

        if ($managers->count() == 1 && in_array($this->id, $managers->pluck('id')->all())) {
            $managers = $this->departments->map(function ($department) {
                return $department->ad;
            });
        }

        return $managers;
    }

    /**
     * @return bool
     */
    public function isManager()
    {
        return in_array($this->id, $this->departments->pluck('manager_id')->all())
            || in_array($this->id, $this->departments->pluck('ad_id')->all());
    }

    /**
     * @param $user
     * @return bool
     */
    public function isManagerOf($user)
    {
        return $user->getLineManagers()->contains($this->id);
    }

    /**
     * Checks to see if the user is on probation.
     *
     * @return bool
     */
    public function isOnProbation()
    {
        return $this->meta->probation_end_date != null;
    }

    /**
     * @param $value
     * @return string
     */
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getSurnameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * @param $email
     */
    public function setUsernameAttribute($email)
    {
        $username = explode('@', strtolower($email))[0];
        $matches = $this->where('username', 'LIKE', "$username%")->get();

        if ($matches->count() > 1) {
            $data = collect();

            foreach ($matches as $match) {
                $data->push((int)str_replace($username, '', $match->username));
            }

            $sorted = $data->sort();
            $username = $username . ($sorted->last() + 1);
        }

        $this->attributes['username'] = $username;
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        if ($this->first_name) {
            return ucwords($this->first_name . ' ' . $this->surname);
        }
    }
}