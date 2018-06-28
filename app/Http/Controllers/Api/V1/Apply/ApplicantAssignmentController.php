<?php

namespace App\Http\Controllers\Api\V1\Apply;

use Illuminate\Http\Request;
use App\UserManager\Users\User;
use App\Apply\Models\Applicant;
use App\Http\Controllers\Controller;
use App\Events\Apply\ApplicantWasAssigned;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ApplicantAssignmentController extends Controller
{
    /**
     * @param         $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($id, Request $request)
    {
        try {
            $applicant = Applicant::findOrFail($id);
            $applicant->assignAdviser(User::findOrFail($request->adviser_id));
            event(new ApplicantWasAssigned($applicant));

            return $this->response($applicant);
        } catch (ModelNotFoundException $e) {
            return $this->response([
                'errors' => [
                    'status' => 422,
                    'source' => ['pointer' => '/data/attributes/adviser_id'],
                    'title' => 'User Unknown',
                    'detail' => 'Pleas select a current member of staff',
                ],
            ], 422);
        }
    }
}
