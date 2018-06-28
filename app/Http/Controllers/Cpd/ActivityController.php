<?php

namespace App\Http\Controllers\Cpd;

use App\Cpd\Cv;
use App\Cpd\User;
use App\Apply\Models\ContractYear;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id)->load('cv', 'certificates');

        return view('cpd.dashboard-user', [
            'contractYear' => (new ContractYear())->dateRange(),
            'user' => $user,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('cpd.activities.create');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        return view('cpd.activities.edit');
    }
}
