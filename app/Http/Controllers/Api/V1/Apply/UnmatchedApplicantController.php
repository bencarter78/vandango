<?php

namespace App\Http\Controllers\Api\V1\Apply;

use App\Apply\Models\Applicant;
use App\Http\Controllers\Controller;

class UnmatchedApplicantController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->response([
            'applicants' => Applicant::with('adviser', 'eportfolio.centre', 'sector', 'submittedBy')->whereNull('episode_ident')->orderBy('starting_on')->get(),
        ]);
    }
}
