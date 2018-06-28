<?php

namespace App\Http\Controllers\Apply;

use Auth;
use App\Contracts\HttpClient;
use App\Apply\Models\Applicant;
use App\Http\Controllers\Controller;

class UserApplicantController extends Controller
{
    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * ApplicantController constructor.
     *
     * @param $client
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('apply.me.applicants', [
            'applicants' => Applicant::where('user_id', $user->id)
                                     ->orWhere('adviser_id', $user->id)
                                     ->orderBy('starting_on')
                                     ->orderBy('surname')
                                     ->orderBy('first_name')
                                     ->get(),
        ]);
    }
}
