<?php

namespace App\Http\Controllers\Api\V1\Apply;

use Illuminate\Http\Request;
use App\Apply\Models\Applicant;
use App\UserManager\Users\User;
use App\Http\Controllers\Controller;
use App\Jobs\Apply\NotifyUserPaperworkHasIssue;

class ApplicantPaperworkIssueController extends Controller
{
    /**
     * @param         $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($id, Request $request)
    {
        $this->validate(request(), ['description' => 'required']);

        $this->dispatch(
            new NotifyUserPaperworkHasIssue(
                Applicant::findOrFail($id), User::findOrFail($request->user_id), request()->all()
            )
        );

        return $this->response();
    }
}
