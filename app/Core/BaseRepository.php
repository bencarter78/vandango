<?php

namespace App\Core;

use Illuminate\Contracts\Queue\EntityNotFoundException;

class BaseRepository
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
     * @param null   $relations
     * @return mixed
     */
    public function getAll($orderBy = 'id', $sort = 'asc', $relations = null)
    {
        $query = $this->model->orderBy($orderBy, $sort);
        if ($relations !== null) {
            foreach ($relations as $relation) {
                $query->with($relation);
            }
        }

        return $query->get();
    }

    /**
     * @param        $paginate
     * @param string $orderBy
     * @param string $sort
     * @param null   $relations
     * @return mixed
     */
    public function getAllPaginated($paginate = 25, $orderBy = 'id', $sort = 'asc', $relations = null)
    {
        $query = $this->model->orderBy($orderBy, $sort);
        if ($relations !== null) {
            foreach ($relations as $relation) {
                $query->with($relation);
            }
        }

        return $query->paginate($paginate);
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
            throw new EntityNotFoundException($this->model, $id);
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
        return $withTrashed != null
            ? $this->model->withTrashed()->find($id)
            : $this->model->find($id);
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
     * @param $search
     * @param $update
     * @return mixed
     */
    public function updateOrCreate($search, $update)
    {
        return $this->model->updateOrCreate($search, $update);
    }

    /**
     * @param $id
     * @return bool|null
     */
    public function restoreById($id)
    {
        return $this->model->withTrashed()->find($id)->restore();
    }

    /**
     * @param $input
     * @param $fillable
     * @return mixed
     * @deprecated
     */
    public function mapInputToFillable($input, $fillable)
    {
        foreach ($fillable as $attribute) {
            if (isset($input[$attribute])) {
                $data[$attribute] = $input[$attribute];
            }
        }

        return $data;
    }

    /**
     * @param $input
     * @param $model
     * @return mixed
     * @deprecated
     */
    public function mapInputToModel($input, $model)
    {
        foreach ($input as $key => $value) {
            if ($this->model->isFillable($key)) {
                $model->{$key} = $value;
            }
        }

        return $model;
    }

    /**
     * @param      $value
     * @param      $attribute
     * @param null $withTrashed
     * @return mixed
     */
    public function exists($value, $attribute, $withTrashed = null)
    {
        $query = $this->model->where($attribute, $value);

        if ($withTrashed) {
            $query->withTrashed();
        }

        return $query->first();
    }

    /**
     * @param      $column
     * @param      $value
     * @param null $withTrashed
     * @param null $paginate
     * @return mixed
     */
    public function findBy($column, $value, $withTrashed = null, $paginate = null)
    {
        $q = $this->model->where($column, $value);

        if ($withTrashed) {
            $q->withTrashed();
        }

        return $paginate ? $q->paginate($paginate) : $q->get();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function findByName($name)
    {
        return $this->findBy('name', $name);
    }

    /**
     * @param      $column
     * @param      $value
     * @param null $paginate
     * @return mixed
     */
    public function searchBy($column, $value, $paginate = null)
    {
        $q = $this->model->where($column, 'LIKE', "%$value%");

        return $paginate ? $q->paginate($paginate) : $q->get();
    }

    /**
     * @param string $select
     * @return User
     */
    public function selectFullNameConcatenated($select = '*')
    {
        return env('DB_CONNECTION') == 'testing'
            ? $this->model->select($select, \DB::raw("first_name || ' ' || surname as name"))
            : $this->model->select($select, \DB::raw("concat(first_name, ' ', surname) as name"));
    }
} 