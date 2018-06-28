<?php

namespace App\Judi\Repositories;

use App\Judi\Models\User;
use App\UserManager\Users\UserRepository as BaseUserRepository;

class UserRepository extends BaseUserRepository
{
    /**
     * @var User
     */
    protected $model;

    /**
     * @param User $model
     */
    function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getStaff($orderBy = 'id', $sort = 'asc')
    {
        return $this->selectNameConcatenated()
                    ->with('meta', 'departments', 'sectors', 'assessments', 'roles', 'roles.processes')
                    ->orderBy($orderBy, $sort)
                    ->get();
    }

    /**
     * @param       $id
     * @param array $data
     * @return array
     */
    public function updateProcesses($id, array $data)
    {
        return $this->model->findOrFail($id)->processes()->sync($data);
    }

    /**
     * @param null $processId
     * @return mixed
     */
    public function getProcessAssessors($processId = null)
    {
        return $this->selectFullNameConcatenated()->whereHas('processes', function ($q) use ($processId) {
            $q->where('process_id', $processId);
        })->get();
    }

    /**
     * @param $sector
     * @return mixed
     */
    public function getAssessableSectorStaff($sector)
    {
        return $this->model
            ->whereHas('sectors', function ($q) use ($sector) {
                $q->where('id', $sector->id);
            })
            ->whereHas('roles', function ($q) {
                $q->has('processes');
            })
            ->with('roles', 'roles.processes', 'assessments')
            ->get();
    }

    /**
     * @return mixed
     */
    public function getJudiAdmin()
    {
        return $this->model->whereHas('groups', function ($q) {
            $q->where('slug', config('vandango.judiAdminSlug'));
        })->get();
    }

    /**
     * @param User $user
     * @return \Illuminate\Support\Collection
     */
    public function getUserProcesses(User $user)
    {
        return $user->roles->map->processes->first();
    }

    /**
     * @param User $user
     * @param      $process
     * @return mixed
     */
    public function userHasProcessAssessmentScheduled(User $user, $process)
    {
        return $user->assessments->filter(function ($a) use ($process) {
            if ($a->process_id == $process->id) {
                return $a;
            }
        });
    }

}