<?php

namespace App\Http\Controllers\Api\V1\Blink;

use App\Jobs\Apply\SaveApplicant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blink\ApplicantRequest;

class ApplicantController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param ApplicantRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ApplicantRequest $request)
    {
        return $this->response($this->dispatch(new SaveApplicant($request->all())));
    }
}
