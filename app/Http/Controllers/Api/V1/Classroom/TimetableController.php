<?php

namespace App\Http\Controllers\Api\V1\Classroom;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classroom\Repositories\Timetable;

class TimetableController extends Controller
{
    protected $timetable;

    /**
     * TimetableController constructor.
     *
     * @param $timetable
     */
    public function __construct(Timetable $timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('expired')) {
            return $this->timetable->getExpiredCourses();
        }

        return $this->timetable->getUpcomingCourses();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->timetable->requireById($id)->load(
            'course', 'users', 'users.departments', 'guests', 'venue', 'venue.site', 'venue.site.location',
            'users.agreements'
        );
    }

}
