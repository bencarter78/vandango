<?php

namespace App\Http\Controllers\Api\V1\Locations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RoomMate\Repositories\Rooms;

class VenueSearchController extends Controller
{
    /**
     * @var Rooms
     */
    protected $repository;

    /**
     * RoomSearchController constructor.
     *
     * @param $repository
     */
    public function __construct(Rooms $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('q')) {
            return $this->repository->search($request->get('q'));
        }
    }
}
