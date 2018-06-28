<?php

namespace App\UserManager\Sectors;

use App\Exceptions\SectorCodeExistsException;
use App\UserManager\Repositories\UserManagerRepository;

class SectorRepository extends UserManagerRepository
{
    /**
     * @var Sector
     */
    protected $model;

    /**
     * @param Sector $model
     */
    public function __construct(Sector $model)
    {
        $this->model = $model;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $this->checkExists('code', $data['code']);

        return $this->add($data);
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
        return $this->updateIfNotExists($id, $data, 'code');
    }

    /**
     * Returns the staff associated with a particular category
     * (Department/Sector/Role)
     *
     * @param $id
     * @return mixed
     */
    public function getSectorStaff($id)
    {
        return $this->getRelationshipUsers($id);
    }

    /**
     * Returns a given sector by search term
     *
     * @param      $search    string
     * @param null $paginate
     * @return User
     */
    public function searchByName($search, $paginate = null)
    {
        $results = $this->model->where('name', 'LIKE', '%' . $search . '%')
                               ->orWhere('code', 'LIKE', '%' . $search . '%');

        if ($paginate != null) {
            return $results->paginate($paginate);
        }

        return $results->get();
    }
}