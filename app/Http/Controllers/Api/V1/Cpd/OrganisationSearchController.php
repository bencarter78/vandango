<?php

namespace App\Http\Controllers\Api\V1\Cpd;

use App\Cpd\Organisation;
use App\Http\Controllers\Controller;

class OrganisationSearchController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->response(Organisation::where('name', 'LIKE', '%' . request('q') . '%')->orderBy('name')->get());
    }
}
