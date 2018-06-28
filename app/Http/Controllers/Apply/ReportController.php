<?php

namespace App\Http\Controllers\Apply;

use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('apply.reports.index');
    }
}
