<?php

namespace App\Http\Controllers\Api\V1\Apply;

use App\Apply\Models\Sector;
use App\Apply\Models\ContractYear;
use App\Http\Controllers\Controller;

class SectorController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $contractYear = new ContractYear();

        return $this->response([
            'sectors' => Sector::with('applicants', 'applicants.adviser', 'applicants.user', 'applicants.qualificationPlan', 'applicants.enquiry', 'applicants.enquiry.contact', 'applicants.enquiry.contact.organisation')
                               ->whereHas('applicants', function ($q) use ($contractYear) {
                                   $q->whereBetween('starting_on', [$contractYear->getYearStart(), $contractYear->getYearEnd()]);
                               })->orderBy('code')->get(),
            'contractYear' => $contractYear->periods(),
        ]);
    }

}
