<?php

namespace App\Http\Controllers\Api\V1\Apply;

use Carbon\Carbon;
use App\Apply\Models\Applicant;
use App\Http\Controllers\Controller;

class PaperworkReceivedController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $applicant = Applicant::findOrFail($id);
        $applicant->update(['received_at' => Carbon::now()]);

        return $this->response($applicant);
    }
}
