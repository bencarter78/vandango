<?php

namespace App\Http\Controllers\Cpd;

use App\Cpd\Cv;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CvController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();

        return view('cpd.cv.edit', [
            'cv' => Cv::whereUserId($user->id)->first() ?: new Cv(['user_id' => $user->id]),
        ]);
    }
}
