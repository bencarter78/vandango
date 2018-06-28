<?php

namespace App\Http\Controllers\Api\V1\Blink;

use App\Blink\Models\Vacancy;
use App\Http\Controllers\Controller;

class VacancyHireController extends Controller
{
    /**
     * @param Vacancy $vacancy
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Vacancy $vacancy)
    {
        $this->validate(request(), [
            'applicant_id' => ['required'],
            'user_id' => ['required'],
            'filled_by' => ['required']
        ]);

        if ( ! $vacancy->hasHired(request('applicant_id'))) {
            $vacancy->hire(request('applicant_id'), request('user_id'), request('filled_by'));
        }

        return $this->response();
    }
}
