<?php

namespace App\Http\Controllers\Api\V1\UserManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\UserManager\Users\UserRepository;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * UserController constructor.
     *
     * @param $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return $this->users->getAll('first_name', 'asc', ['departments', 'sectors', 'meta']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->users->getById($id, true);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        if ($request->has('q')) {
            return $this->users->search($request->get('q'));
        }
    }

}
