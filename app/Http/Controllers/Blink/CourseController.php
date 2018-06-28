<?php

namespace App\Http\Controllers\Blink;

use App\Blink\Models\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blink\CourseRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('blink.courses.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        abort_if(! Auth::user()->can('create', Course::class), Response::HTTP_UNAUTHORIZED, 'You do not have permission to view this page');

        return view('blink.courses.create');
    }

    /**
     * @param Course $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Course $course)
    {
        return view('blink.courses.show', ['course' => $course]);
    }

    /**
     * @param Course $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Course $course)
    {
        abort_if(! Auth::user()->can('edit', Course::class), Response::HTTP_UNAUTHORIZED, 'You do not have permission to view this page');

        return view('blink.courses.edit', ['course' => $course]);
    }
}
