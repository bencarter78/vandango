<?php

namespace App\Http\Controllers\Classroom;

use Auth;
use App\Classroom\Models\User;
use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('classroom.me.dashboard', [
            'user' => User::with('timetable')->find(Auth::user()->id),
        ]);
    }
}
