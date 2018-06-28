<?php

namespace App\Http\Controllers\Classroom;

use App\UserManager\Roles\Role;
use App\Classroom\Models\Course;
use App\Classroom\Models\CourseType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Classroom\CourseRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('classroom.courses.index', [
            'courses' => Course::orderBy('name')->paginate(25),
            'roles' => Role::orderBy('job_role')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classroom.courses.create', [
            'roles' => Role::orderBy('job_role')->get(),
            'types' => CourseType::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CourseRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $course = Course::create([
            'name' => $request->get('name'),
            'aim_ref' => $request->get('aim_ref'),
            'course_type_id' => $request->get('course_type_id'),
            'is_mandatory' => $request->get('is_mandatory'),
            'is_agreement_required' => $request->get('is_agreement_required'),
            'cost' => $request->get('cost'),
            'description' => $request->get('description'),
            'resource_url' => $request->get('resource_url'),
        ]);

        if ($request->get('role_id') == null) {
            $roles = [];
        } else {
            $roles = $request->get('role_id');
        }

        $course->roles()->sync($roles);

        return redirect()->route('classroom.courses.index')->with('success', 'You have successfully added a new course');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('classroom.courses.edit', [
            'course' => Course::find($id),
            'roles' => Role::orderBy('job_role')->get(),
            'types' => CourseType::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CourseRequest $request
     * @param  int          $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        $course = Course::find($id);

        $course->update([
            'name' => $request->get('name'),
            'course_type_id' => $request->get('course_type_id'),
            'aim_ref' => $request->get('aim_ref'),
            'is_mandatory' => $request->get('is_mandatory'),
            'is_agreement_required' => $request->get('is_agreement_required'),
            'cost' => $request->get('cost'),
            'description' => $request->get('description'),
            'resource_url' => $request->get('resource_url'),
        ]);

        if ($request->get('role_id') == null) {
            $roles = [];
        } else {
            $roles = $request->get('role_id');
        }

        $course->roles()->sync($roles);

        return redirect()->route('classroom.courses.index')->with('success', 'You have successfully updated the course');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        $course->timetable->each(function ($course) {
            $course->delete();
        });

        $course->delete();

        return back()->with('success', 'You have successfully deleted the course and removed it from the timetable');
    }
}
