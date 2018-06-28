<?php

namespace App\Http\Controllers\Classroom;

use App\Classroom\Models\Course;
use App\Http\Controllers\Controller;
use App\Classroom\Repositories\Timetable;
use App\Http\Requests\Classroom\TimeTableRequest;
use App\Events\Classroom\ScheduledCourseWasUpdated;

class TimetableController extends Controller
{
    /**
     * @var
     */
    protected $timetable;

    /**
     * @var array
     */
    private $scheduledCourseTypesIds = [1];

    /**
     * TimetableController constructor.
     *
     * @param       $timetable
     */
    public function __construct(Timetable $timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('classroom.timetable.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classroom.timetable.create', [
            'courses' => Course::orderBy('name')->whereHas('type', function ($q) {
                $q->whereIn('id', $this->scheduledCourseTypesIds);
            })->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TimeTableRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TimeTableRequest $request)
    {
        if ($request->get('ends_at') < $request->get('starts_at')) {
            return back()->withInput()->with('error', 'Whoops! The course ends before it has begun!');
        }

        $this->timetable->add([
            'course_id' => $request->get('course_id'),
            'trainer_id' => $request->get('user_id'),
            'room_id' => $request->get('room_id'),
            'starts_at' => $request->get('starts_at'),
            'ends_at' => $request->get('ends_at'),
        ]);

        return redirect()->route('classroom.timetable.index')
                         ->with('success', 'You have successfully added the scheduled course.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('classroom.timetable.show', [
            'timetable' => $this->timetable->requireById($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('classroom.timetable.edit', [
            'timetable' => $this->timetable->requireById($id),
            'courses' => Course::orderBy('name')->whereHas('type', function ($q) {
                $q->whereIn('id', $this->scheduledCourseTypesIds);
            })->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TimeTableRequest $request
     * @param  int             $id
     * @return \Illuminate\Http\Response
     */
    public function update(TimeTableRequest $request, $id)
    {
        if ($request->get('ends_at') < $request->get('starts_at')) {
            return back()->withInput()->with('error', 'The end date and time is before the start date and time.');
        }

        $timetable = $this->timetable->requireById($id);
        $timetable->course_id = $request->get('course_id');
        $timetable->trainer_id = $request->get('user_id');
        $timetable->room_id = $request->get('room_id');
        $timetable->starts_at = $request->get('starts_at');
        $timetable->ends_at = $request->get('ends_at');

        if ($timetable->isDirty()) {
            event(new ScheduledCourseWasUpdated($timetable));
        }

        $timetable->save();

        return redirect()->route('classroom.timetable.index')
                         ->with('success', 'You have successfully updated the scheduled course.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = $this->timetable->requireById($id);
        $course->delete();

        return back()->with('success', 'You have successfully deleted the scheduled course');
    }
}
