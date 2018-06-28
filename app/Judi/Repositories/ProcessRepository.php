<?php

namespace App\Judi\Repositories;

use App\Core\BaseRepository;
use App\Judi\Models\Process;
use App\Exceptions\ProcessExistsException;

class ProcessRepository extends BaseRepository
{
    /**
     * @var Process
     */
    protected $model;

    /**
     * @param Process $model
     */
    function __construct(Process $model)
    {
        $this->model = $model;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $this->checkProcessExists($data['name']);
        $process = $this->add($data);
        $this->syncRoles($process, $data);

        return $process;
    }

    /**
     * @param $process
     * @return mixed
     * @throws ProcessExistsException
     */
    private function checkProcessExists($process)
    {
        if ($this->model->where('name', $process)->first()) {
            throw new ProcessExistsException('A PA process already exists in the database with this name.');
        }
    }

    /**
     * @param $process
     * @param $data
     * @return
     */
    private function syncRoles($process, $data)
    {
        if ( ! isset($data['role_id'])) {
            return $process->roles()->detach();
        }

        return $process->roles()->sync($data['role_id']);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $process = $this->model->find($id);
        $process->update($data);
        $this->syncRoles($process, $data);
        $this->syncReports($process, $data);

        return $process;
    }

    /**
     * @param $process
     */
    private function syncReports($process, $data)
    {
        if ( ! isset($data['report_id'])) {
            return $process->reports()->detach();
        }

        return $process->reports()->sync($data['report_id']);
    }

    /**
     * @param array $userRoles
     */
    public function getUserProcesses($userRoles = [])
    {
        return $this->model->whereHas('roles', function ($q) use ($userRoles) {
            $q->whereIn('role_id', $userRoles);
        })->get();
    }

}