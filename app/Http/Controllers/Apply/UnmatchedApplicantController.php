<?php

namespace App\Http\Controllers\Apply;

use JavaScript;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UnmatchedApplicantController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        JavaScript::put('authUser', Auth::user());

        return view('apply.applicants.unmatched');
    }
}
