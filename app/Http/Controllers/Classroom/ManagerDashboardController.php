<?php

namespace App\Http\Controllers\Classroom;

use App\Classroom\Models\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserManager\Users\UserRepository;

class ManagerDashboardController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * ManagerDashboardController constructor.
     *
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
        $this->middleware(['auth.isManager']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $authUser = Auth::user();
        $users = $authUser->departments->map(function ($dept) use ($authUser) {
            return $dept->users->reject(function ($user) use ($authUser) {
                return $user->id === $authUser->id;
            })->map(function ($user) {
                return $user;
            });
        })->flatten();

        return view('classroom.manager.users', ['users' => $users]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $authUser = Auth::user();
        $user = User::find($id);

        if ($authUser->isManagerOf($user) || $authUser->hasAccess('classroomAdmin')) {
            return view('classroom.manager.user-timetable', ['user' => $user->load('timetable')]);
        }

        return back()->with('error', 'You do not have access to this user\'s timetable.');
    }
}
