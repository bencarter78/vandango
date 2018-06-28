<?php

namespace App\UserManager\Departments;

use App\Exceptions\DepartmentExistsException;
use App\UserManager\Repositories\UserManagerRepository;

class DepartmentRepository extends UserManagerRepository
{
    /**
     * @var Department
     */
    protected $model;

    /**
     * @param Department $model
     */
    public function __construct(Department $model)
    {
        $this->model = $model;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $this->checkExists('department', $data['department']);

        return $this->add($data);
    }

    /**
     * Update a department
     *
     * @param $id
     * @param $data
     * @return mixed
     * @throws DepartmentExistsException
     */
    public function update($id, $data)
    {
        return $this->updateIfNotExists($id, $data, 'department');
    }

    /**
     * Returns a given department by search term
     *
     * @param      $search    string
     * @param null $paginate
     * @return User
     */
    public function searchByNamePaginated($search, $paginate = null)
    {
        return $this->searchBy('department', $search, $paginate);
    }
}