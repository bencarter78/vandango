<?php

namespace App\Http\Controllers\Api\V1\UserManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserManager\Users\GuestRepository;
use App\Http\Requests\UserManager\GuestRequest;

class GuestController extends Controller
{
    /**
     * @var GuestRepository
     */
    private $guests;

    /**
     * GuestController constructor.
     *
     * @param GuestRepository $guests
     */
    public function __construct(GuestRepository $guests)
    {
        $this->guests = $guests;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->guests->getAll('first_name');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GuestRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuestRequest $request)
    {
        return $this->guests->updateOrCreate(['email' => $request->get('email')], $request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->guests->requireById($id);
    }
}
