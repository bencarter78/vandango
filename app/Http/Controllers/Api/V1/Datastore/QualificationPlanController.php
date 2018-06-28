<?php

namespace App\Http\Controllers\Api\V1\Datastore;

use App\Pics\QualificationPlan;
use App\Http\Controllers\Controller;

class QualificationPlanController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if (request()->has('sector_id')) {
            $data = QualificationPlan::with('sector')->whereSectorId(request('sector_id'))->first();
        } else {
            $data = QualificationPlan::with('sector')->orderBy('description')->get();
        }

        return $this->response($data);
    }
}
