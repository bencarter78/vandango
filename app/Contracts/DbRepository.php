<?php

namespace App\Contracts;

use App\Core\EntityNotFoundException;

interface DbRepository
{
    /**
     * @return null
     */
    public function getModel();

    /**
     * @param $model
     */
    public function setModel($model);

    /**
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getAll($orderBy = 'id', $sort = 'asc');

    /**
     * @param        $paginate
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getAllPaginated($paginate, $orderBy = 'id', $sort = 'asc');

    /**
     * @param        $count
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getAllTrashedPaginated($count, $orderBy = 'id', $sort = 'asc');

    /**
     * @param      $id
     * @param null $withTrashed
     * @return mixed
     * @throws EntityNotFoundException
     */
    public function requireById($id, $withTrashed = null);

    /**
     * @param      $id
     * @param null $withTrashed
     * @return mixed
     */
    public function getById($id, $withTrashed = null);

    /**
     * @param $data
     * @return mixed
     */
    public function add($data);

    /**
     * @param $data
     * @return mixed
     */
    public function save($data);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function getNew($attributes = []);

    /**
     * @param $model
     * @return mixed
     */
    public function delete($model);

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data);

    /**
     * @param $id
     * @return bool|null
     */
    public function restoreById($id);
}