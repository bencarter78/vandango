<?php

namespace App\Http\Controllers\Api\V1\Blink;

use App\Blink\Models\Organisation;
use App\Http\Controllers\Controller;

class OrganisationEnquiryController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $organisations = Organisation::with('enquiries', 'contacts', 'enquiries.applicants', 'enquiries.contact', 'enquiries.opportunities', 'enquiries.owners', 'enquiries.vacancies')->has('enquiries');

        if (request()->has('id')) {
            return $this->response($organisations->findOrFail(request('id')));
        }

        if (request()->has('name')) {
            $organisations->whereName(request('name'));
        }

        return $this->response($organisations->get());
    }
}
