<?php

namespace App\Http\Controllers\Api\V1\Apply;

use Carbon\Carbon;
use App\Jobs\Apply\Match;
use Illuminate\Http\Request;
use App\Apply\Models\Applicant;
use App\Http\Controllers\Controller;
use App\Events\Apply\StartWasIdentified;
use App\Http\Requests\Apply\ApplicantRequest;

class ApplicantController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $applicants = Applicant::with('adviser', 'sector', 'qualificationPlan', 'submittedBy')->orderBy('surname')->orderBy('first_name')->get();

        return $this->response($applicants);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ApplicantRequest $request
     * @return \Illuminate\Http\JsonResponse
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
            'enquiry_id' => $request->enquiry_id,
            'user_id' => $request->user_id,
            'adviser_id' => $request->adviser_id,
            'first_name' => $request->first_name,
            'surname' => $request->surname,
            'email' => $request->email,
            'dob' => Carbon::createFromFormat('d/m/Y', $request->dob),
            'sector_id' => $request->sector_id,
            'qualification_plan_id' => $request->qualification_plan_id,
            'programme_type' => $request->programme_type,
            'starting_on' => Carbon::createFromFormat('d/m/Y', $request->get('starting_on'))->format('Y-m-d'),
        ]);

        event(new StartWasIdentified($applicant));

        $match = $this->matchIfMatching($applicant);

        if (request('centre_id')) {
            $applicant->eportfolio()->create(['centre_id' => request('centre_id')]);
        }

        return $this->response(['applicant' => $applicant->load('adviser', 'sector', 'qualificationPlan', 'submittedBy'), 'match' => $match]);
    }

    /**
     * @param                  $id
     * @param ApplicantRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, ApplicantRequest $request)
    {
        $applicant = Applicant::findOrFail($id);

        if ($applicant) {
            $applicant->update([
                'sector_id' => $request->sector_id,
                'qualification_plan_id' => $request->qualification_plan_id,
                'programme_type' => $request->programme_type,
                'adviser_id' => $request->adviser_id,
                'first_name' => $request->first_name,
                'surname' => $request->surname,
                'dob' => isset($request->dob) ? Carbon::createFromFormat('d/m/Y', $request->dob) : null,
                'email' => $request->email,
            ]);

            $match = $this->matchIfMatching($applicant);

            if (request('centre_id')) {
                $applicant->eportfolio()->create(['centre_id' => request('centre_id')]);
            }

            return $this->response(['applicant' => $applicant->load('adviser', 'sector', 'qualificationPlan', 'submittedBy'), 'match' => $match]);
        }

        return $this->response(['errors' => 'There has been an error'], 400);
    }

    /**
     * @param         $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id, Request $request)
    {
        Applicant::findOrFail($id)->withdraw($request->withdrawal_id);

        return $this->response($request->all());
    }

    /**
     * @param $applicant
     * @return mixed
     */
    private function matchIfMatching($applicant)
    {
        if (request('match') == true) {
            return $this->dispatch(new Match($applicant));
        }
    }
}
