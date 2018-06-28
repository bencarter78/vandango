<?php

namespace App\UserManager\Roles;

use App\Exceptions\SectorCodeExistsException;
use App\UserManager\Repositories\UserManagerRepository;

class RoleRepository extends UserManagerRepository
{
    /**
     * @var Role
     */
    protected $model;

    /**
     * RoleRepository constructor.
     *
     * @param Role $model
     */
    function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $orderBy
     * @return mixed
     */
    public function getRoles($orderBy = 'job_role')
    {
        return $this->getAll($orderBy);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $this->checkExists('job_role', $data['job_role']);

        return $this->add(['job_role' => $data['job_role']]);
    }

    /**
     * Update a sector
     *
     * @param $id
     * @param $data
     * @return mixed
     * @throws SectorCodeExistsException
     * @throws \App\Core\EntityNotFoundException
     */
    public function update($id, $data)
    {
        return $this->updateIfNotExists($id, $data, 'job_role');
    }

    /**
     * Returns the staff associated with a jpb role
     *
     * @param $id
     * @return mixed
     */
    public function getRoleStaff($id)
    {
        return $this->getRelationshipUsers($id);
    }

}