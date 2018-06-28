<?php

namespace App\Http\Controllers\UserManager;

use App\Http\Controllers\Controller;
use App\UserManager\Users\UserRepository;
use App\Events\UserManager\UserWasDeleted;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var string
     */
    protected $package = 'UserManager';

    /**
     * @var UserRepositoryInterface
     */
    protected $users;

    /**
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('auth');

        $this->users = $users;
        $this->pageTitle = 'User Accounts';
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
//        dd($request);
        return view('usermanager.search');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $user = $this->users->requireById($id)->delete();
        event(new UserWasDeleted($user));

        return redirect()->to('/usermanager')
                         ->with('success', 'User has been successfully deleted.');
    }
}