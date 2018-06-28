<?php

namespace App\Http\Controllers\Api\V1\Blink;

use App\Blink\Models\Opportunity;
use App\Http\Controllers\Controller;

class OpportunityController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $opportunities = Opportunity::with('enquiry', 'enquiry.contact', 'enquiry.contact.organisation', 'enquiry.owners', 'enquiry.statuses', 'enquiry.vacancies', 'enquiry.applicants', 'sector')
                                    ->orderBy('expected_on')
                                    ->get();

        return $this->response($opportunities);
    }
}
