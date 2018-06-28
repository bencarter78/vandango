<?php

namespace App\UserManager\Users;

use DB;
use Carbon\Carbon;
use App\UserManager\Repositories\UserManagerRepository;

class UserRepository extends UserManagerRepository
{
    /**
     * @var User
     */
    protected $model;

    /**
     * @param User              $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @deprecated
     * Should use BaseRepository::selectFullNameConcatenated()
     *
     * @param string $select
     * @return User
     */
    public function selectNameConcatenated($select = '*')
    {
        return env('DB_CONNECTION') == 'testing'
            ? $this->model->select($select, \DB::raw("first_name || ' ' || surname as name"))
            : $this->model->select($select, \DB::raw("concat(first_name, ' ', surname) as name"));
    }

    /**
     * Returns user by email
     *
     * @param    $email        string
     * @return    User
     */
    public function findByEmail($email)
    {
        return $this->findBy('email', trim($email), true)->first();
    }

    /**
     * Returns user by username
     *
     * @param    $username        string
     * @return    User
     */
    public function findByUsername($username)
    {
        return $this->findBy('username', strtolower(str_replace(' ', '', $username)))
                    ->load('sectors', 'departments', 'roles', 'groups', 'meta')
                    ->first();
    }

    /**
     * Returns a user based on a given username/id
     *
     * @param $value
     * @return mixed
     */
    public function findByIdOrUsername($value)
    {
        return $this->model->where('id', $value)->orWhere('username', $value)->first();
    }

    /**
     * Get all of the department managers
     *
     * @return mixed
     */
    public function getDepartmentManagers()
    {
        return $this->selectNameConcatenated('id')
                    ->has('departments')
                    ->whereHas('roles', function ($q) {
                        $q->where('job_role', config('vandango.usermanager.departments.manager.name'));
                    })
                    ->orderBy('first_name')
                    ->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUsersBySector($id)
    {
        return $this->selectNameConcatenated()
                    ->whereHas('sectors', function ($q) use ($id) {
                        $q->where('id', $id);
                    })->get();
    }

    /**
     * Get all of the users with a given job role
     *
     * @deprecated
     * Use getUsersByRoleId()
     *
     * @param $roleId
     * @return mixed
     */
    public function getUsersWithRole($roleId)
    {
        return $this->getUsersByRoleId($roleId);
    }

    /**
     * Get all of the users with a given job role
     *
     * @param $id
     * @return mixed
     */
    public function getUsersByRoleId($id)
    {
        return $this->selectNameConcatenated()
                    ->whereHas('roles', function ($q) use ($id) {
                        $q->where('role_id', $id);
                    })
                    ->orderBy('first_name')
                    ->get();
    }

    /**
     * Get all of the users with a given job role
     *
     * @param $name
     * @return mixed
     */
    public function getUsersByRoleName($name)
    {
        return $this->selectNameConcatenated()
                    ->whereHas('roles', function ($q) use ($name) {
                        $q->where('job_role', $name);
                    })
                    ->orderBy('first_name')
                    ->get();
    }

    /**
     * Get the directors for the company
     *
     * @return mixed
     */
    public function getDirectors()
    {
        return $this->selectNameConcatenated()
                    ->whereHas('departments', function ($q) {
                        $q->where('department', config('vandango.usermanager.departments.directors.name'));
                    })
                    ->orderBy('first_name')
                    ->get();
    }

    /**
     * Get all users whose Probation end date is today
     *
     * @return mixed
     */
    public function getAllUsersEndingProbationToday()
    {
        return $this->model->whereHas('meta', function ($q) {
            $q->where('probation_end_date', Carbon::today());
        })->get();
    }

    /**
     * Get all users whose Probation end date is this month
     *
     * @return mixed
     */
    public function getAllUsersEndingProbationInMonth()
    {
        return $this->model->whereHas('meta', function ($q) {
            $now = Carbon::now();
            $q->where('probation_end_date', '>=', $now->firstOfMonth()->addMonth()->format('Y-m-d'))
              ->where('probation_end_date', '<=', $now->lastOfMonth()->format('Y-m-d'));
        })->get();
    }

    /**
     * @return mixed
     */
    public function getAllOnProbation()
    {
        return $this->model->with('meta', 'departments')
                           ->whereHas('departments', function ($q) {
                               $q->where('department', '!=', 'Sub-contractor');
                           })
                           ->whereHas('meta', function ($q) {
                               $q->whereNotNull('probation_end_date');
                           })
                           ->orderBy('first_name')
                           ->get();
    }

    /**
     * @return mixed
     */
    public function getAllUsersWithAppraisalsInMonth()
    {
        return $this->model->whereHas('meta', function ($q) {
            $now = Carbon::now();
            $q->where('appraisal_date', '>=', $now->firstOfMonth()->addMonth()->format('Y-m-d'))
              ->where('appraisal_date', '<=', $now->lastOfMonth()->format('Y-m-d'));
        })->get();
    }


    /**
     * Returns all new users since a given number of days prior
     *
     * @param int $days
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getNewUsers($days = 30)
    {
        return $this->model->with('departments')
                           ->whereHas('meta', function ($q) use ($days) {
                               $q->where('start_date', '>=', Carbon::now()->subDays($days));
                           })
                           ->get();
    }

    /**
     * Returns all leavers since a given number of days prior
     *
     * @param int $days
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getLeavers($days = 30)
    {
        return $this->model->with('departments')
                           ->where('deleted_at', '>=', Carbon::now()->subDays($days))
                           ->withTrashed()
                           ->orderBy('deleted_at')
                           ->get();
    }

    /**
     * Returns users with no department assigned
     *
     * @return mixed
     */
    public function getUsersWithNoAssignedDepartment()
    {
        return $this->model->whereDoesntHave('departments')->orderBy('surname')->orderBy('first_name')->get();
    }

    /**
     * Returns users with no assigned job roles
     *
     * @return mixed
     */
    public function getSectorStaffWithNoAssignedRole()
    {
        return $this->model->with('departments')
                           ->has('sectors')
                           ->whereDoesntHave('roles')
                           ->orderBy('surname')
                           ->orderBy('first_name')
                           ->get();
    }

    /**
     * Returns all users where the search term matches a user/department/sector/role name
     *
     * @param $term
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function search($term)
    {
        $q = env('DB_CONNECTION') == 'testing'
            ? $this->model->where(DB::raw("first_name || ' ' || surname"), 'LIKE', "%$term%")
            : $this->model->where(DB::raw("CONCAT (first_name, ' ', surname)"), 'LIKE', "%$term%");

        return $q
            ->orWhereHas('sectors', function ($q) use ($term) {
                $q->where('name', 'LIKE', '%' . $term . '%');
            })
            ->orWhereHas('departments', function ($q) use ($term) {
                $q->where('department', 'LIKE', '%' . $term . '%');
            })
            ->orWhereHas('roles', function ($q) use ($term) {
                $q->where('job_role', 'LIKE', '%' . $term . '%');
            })
            ->with('departments', 'sectors')
            ->get();
    }
}