<?php

namespace App\RoomMate\Repositories;

use App\Core\BaseRepository;
use App\RoomMate\Models\Room;

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
        $q = $this->model->with('site', 'site.location')
                         ->where('name', 'LIKE', "%$term%")
                         ->orWhereHas('site', function ($q) use ($term) {
                             $q->where('name', 'LIKE', "%$term%");
                         })
                         ->orWhereHas('site.location', function ($q) use ($term) {
                             $q->where('town', 'LIKE', "%$term%")
                               ->orWhere('county', 'LIKE', "%$term%");
                         });

        $capacity = (int)$term;
        if ($capacity > 0) {
            $q->orWhere('capacity', '>=', $capacity);
        }

        return $q->get();
    }
}