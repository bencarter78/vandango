<?php

namespace App\UserManager\Repositories;

use App\Core\BaseRepository;
use App\Exceptions\ModelExistsException;

class UserManagerRepository extends BaseRepository
{
    /**
     * Update a sector
     *
     * @param $id
     * @param $data
     * @param $property
     * @return mixed
     */
    public function updateIfNotExists($id, $data, $property)
    {
        $model = $this->requireById($id)->fill($data);

        if ($model->isDirty($property)) {
            $this->checkExists($property, $model->$property);
        }

        return $model->save();
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     * @throws ModelExistsException
     */
    public function checkExists($key, $value)
    {
        $value = strtolower($value);

        if ($this->model->whereRaw("LOWER($key) = '$value'")->first()) {
            throw new ModelExistsException('An item already exists in the database with the provided data.');
        }
    }

    /**
     * Returns the users associated with a given relationship
     * (Department/Sector/Role)
     *
     * @param $id
     * @return mixed
     */
    public function getRelationshipUsers($id)
    {
        return $this->model->with([
                'users' => function ($q) {
                    $q->orderBy('first_name')->orderBy('surname');
                },
            ]
        )->find($id);
    }
}