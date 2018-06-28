<?php namespace App\Core;

use App\Contracts\DbRepository;

class EloquentRepository implements DbRepository
{
    /**
     * @var null
     */
    protected $model;

    /**
     * @param null $model
     */
    public function __construct($model = null)
    {
        $this->model = $model;
    }

    /**
     * @return null
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getAll($orderBy = 'id', $sort = 'asc')
    {
        return $this->model->orderBy($orderBy, $sort)->get();
    }

    /**
     * @param        $paginate
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getAllPaginated($paginate, $orderBy = 'id', $sort = 'asc')
    {
        return $this->model->orderBy($orderBy, $sort)->paginate($paginate);
    }

    /**
     * @param        $count
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getAllTrashedPaginated($count = 20, $orderBy = 'id', $sort = 'asc')
    {
        return $this->model->onlyTrashed()->orderBy($orderBy, $sort)->paginate($count);
    }

    /**
     * @param      $id
     * @param null $withTrashed
     * @return mixed
     * @throws EntityNotFoundException
     */
    public function requireById($id, $withTrashed = null)
    {
        $model = $this->getById($id, $withTrashed);

        if ( ! $model) {
            throw new EntityNotFoundException;
        }

        return $model;
    }

    /**
     * @param      $id
     * @param null $withTrashed
     * @return mixed
     */
    public function getById($id, $withTrashed = null)
    {
        $model = $this->model;

        if ($withTrashed != null) {
            return $model->withTrashed()->find($id);
        }

        return $model->find($id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function save($data)
    {
        if ($data instanceOf Model) {
            return $this->storeEloquentModel($data);
        } elseif (is_array($data)) {
            return $this->storeArray($data);
        }
    }

    /**
     * @param $model
     * @return mixed
     */
    protected function storeEloquentModel($model)
    {
        if ($model->getDirty()) {
            return $model->save();
        }

        return $model->touch();
    }

    /**
     * @param $data
     * @return mixed
     */
    protected function storeArray($data)
    {
        $model = $this->getNew($data);

        return $this->storeEloquentModel($model);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function getNew($attributes = [])
    {
        return $this->model->newInstance($attributes);
    }

    /**
     * @param $model
     * @return mixed
     */
    public function delete($model)
    {
        return $model->delete();
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        return $this->model->find($id)->update($data);
    }

    /**
     * @param $id
     * @return bool|null
     */
    public function restoreById($id)
    {
        return $this->model->withTrashed()->find($id)->restore();
    }
}