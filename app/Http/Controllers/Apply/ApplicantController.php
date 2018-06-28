<?php

namespace App\Http\Controllers\Apply;

use JavaScript;
use Carbon\Carbon;
use App\Contracts\HttpClient;
use App\Apply\Models\Applicant;
use App\Pics\QualificationPlan;
use App\UserManager\Sectors\Sector;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Events\Apply\StartWasIdentified;
use App\Http\Requests\Apply\ApplicantRequest;

class ApplicantController extends Controller
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
        if ( ! Auth::user()->hasAccess('applyAdmin')) {
            return back()->with('error', 'You are not authorised to visit this page.');
        }

        JavaScript::put('authUser', Auth::user());

        return view('apply.applicants.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        JavaScript::put('authUser', Auth::user());

        return view('apply.applicants.create', [
            'sectors' => Sector::orderBy('name')->get(),
            'qualificationPlans' => QualificationPlan::orderBy('description')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ApplicantRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicantRequest $request)
    {
        $applicant = Applicant::firstOrCreate([
            'first_name' => $request->first_name,
            'surname' => $request->surname,
            'dob' => Carbon::createFromFormat('d/m/Y', $request->dob)->format('Y-m-d'),
            'sector_id' => $request->sector_id,
            'programme_type' => $request->programme_type,
            'qualification_plan_id' => $request->qualification_plan_id,
        ], [
            'user_id' => Auth::user()->id,
            'adviser_id' => $request->user_id,
            'first_name' => $request->first_name,
            'surname' => $request->surname,
            'email' => $request->email,
            'dob' => Carbon::createFromFormat('d/m/Y', $request->dob),
            'sector_id' => $request->sector_id,
            'qualification_plan' => $request->qualification_plan,
            'qualification_plan_id' => $request->qualification_plan_id,
            'programme_type' => $request->programme_type,
            'starting_on' => Carbon::createFromFormat('d/m/Y', $request->get('starting_on'))->format('Y-m-d'),
            'pics_organisation_id' => $request->place,
            'organisation_name' => $request->organisation_name,
            'contact_email' => $request->contact_email,
            'contact_first_name' => $request->contact_first_name,
            'contact_surname' => $request->contact_surname,
        ]);

        event(new StartWasIdentified($applicant));

        return redirect()
            ->route('apply.applicants.index')
            ->with('success', 'You have successfully added the applicant.');
    }

    /**
     * @param         $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        JavaScript::put(['applicant' => Applicant::with('adviser')->findOrFail($id)]);

        return view('apply.applicants.edit');
    }
}
