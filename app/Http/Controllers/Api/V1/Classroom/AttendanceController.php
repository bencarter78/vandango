<?php

namespace App\Http\Controllers\Api\V1\Classroom;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\Classroom\SaveAttendance;
use App\Classroom\Repositories\Timetable;
use App\UserManager\Users\UserRepository;

class AttendanceController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var Timetable
     */
    private $timetable;

    /**
     * AttendanceController constructor.
     *
     * @param UserRepository $users
     * @param Timetable      $timetable
     */
    public function __construct(UserRepository $users, Timetable $timetable)
    {
        $this->users = $users;
        $this->timetable = $timetable;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        $user = $this->users->requireById($request->get('authUser'));

        if ( ! $user->hasAccess('classroomAdmin')) {
            return response([
                'errors' => [
                    'status' => 403,
                    'title' => 'Unauthorised Access',
                    'detail' => 'You do not have permission to make changes',
                ],
            ], 200);
        }

        dispatch(new SaveAttendance($request->all()));

        return response([
            'status' => 'ok',
        ], 200);
    }

}
