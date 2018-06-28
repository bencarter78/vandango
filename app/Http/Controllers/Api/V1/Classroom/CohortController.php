<?php

namespace App\Http\Controllers\Api\V1\Classroom;

use Illuminate\Http\Request;
use App\Classroom\Models\User;
use App\Classroom\Models\Guest;
use App\Jobs\Classroom\AddToCourse;
use App\Http\Controllers\Controller;
use App\Classroom\Repositories\Timetable;
use App\Events\Classroom\UserWasRemovedFromScheduledCourse;

class CohortController extends Controller
{
    /**
     * @var Timetable
     */
    protected $timetable;

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * CohortController constructor.
     *
     * @param $timetable
     */
    public function __construct(Timetable $timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param                           $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $course = $this->timetable->requireById($id);

        if ($request->has('user_id')) {
            $user = User::find($request->user_id);
            $type = 'users';
        }

        if ($request->has('guest_id')) {
            $user = Guest::find($request->guest_id);
            $type = 'guests';
        }

        $this->errors = dispatch(new AddToCourse($user, $course, $type, User::find($request->auth_user_id)));

        return response([
            'ok' => true,
            'errors' => $this->errors,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param         $timetableId
     * @param         $attendeeId
     * @param         $attendeeType
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($timetableId, $attendeeId, $attendeeType, Request $request)
    {
        $authUser = User::find($request->auth_user_id);
        $timetable = $this->timetable->requireById($timetableId);
        $user = $timetable->{$attendeeType}->where('id', $attendeeId)->first();

        if ($attendeeType === 'guests' || $authUser->isManagerOf($user) || $authUser->hasAccess('classroomAdmin')) {
            $timetable->{$attendeeType}()->detach([$attendeeId]);
            event(new UserWasRemovedFromScheduledCourse($user, $timetable));

            return response([
                'ok' => true,
            ], 200);
        }

        return response([
            'ok' => false,
            'errors' => [
                'title' => 'Unauthorised',
                'detail' => 'You do not have permission to remove this person from the course.',
            ],
        ], 403);
    }
}
