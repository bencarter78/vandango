<?php

namespace App\Locations\Repositories;

use App\Locations\Room;
use App\Core\BaseRepository;

class Rooms extends BaseRepository
{
    /**
     * @var Room
     */
    protected $model;

    /**
     * Rooms constructor.
     *
     * @param Room $model
     */
    public function __construct(Room $model)
    {
        $this->model = $model;
    }

    /**
     * @param $term
     * @return mixed
     */
    public function search($term)
    {
        $q = $this->model->with('centre')
                         ->where('name', 'LIKE', "%$term%")
                         ->orWhereHas('centre', function ($q) use ($term) {
                             $q->where('name', 'LIKE', "%$term%")
                               ->orWhere('add4', 'LIKE', "%$term%")
                               ->orWhere('add5', 'LIKE', "%$term%");
                         });

        $capacity = (int)$term;
        if ($capacity > 0) {
            $q->orWhere('capacity', '>=', $capacity);
        }

        return $q->get();
    }
}