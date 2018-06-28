<?php

namespace App\Http\Controllers\Api\V1\RoomMate\Rooms;

use App\RoomMate\Repositories\Rooms;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    /**
     * @var Rooms
     */
    protected $rooms;

    /**
     * RoomController constructor.
     *
     * @param $rooms
     */
    public function __construct(Rooms $rooms)
    {
        $this->rooms = $rooms;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->rooms->getAll('name')->load('site', 'site.location');
    }
}
