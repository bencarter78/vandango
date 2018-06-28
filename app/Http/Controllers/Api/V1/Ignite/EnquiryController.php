<?php

namespace App\Http\Controllers\Api\V1\Ignite;

use Carbon\Carbon;
use App\Blink\Models\Enquiry;
use App\Http\Controllers\Controller;

class EnquiryController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $this->validate(request(), [
            'campaign_id' => 'required',
            'from' => 'date_format:d/m/Y',
            'to' => 'date_format:d/m/Y',
        ], [
            'campaign_id.required' => 'Please select a campaign',
            'from.date_format' => 'Please use the format DD/MM/YYYY',
            'to.date_format' => 'Please use the format DD/MM/YYYY',
        ]);

        $enquiries = Enquiry::withTrashed()->with('applicants', 'contact.organisation', 'opportunities', 'statuses', 'vacancies')
                            ->where('campaign_id', request('campaign_id'))
                            ->when(request()->has('from'), function ($q) {
                                $q->where('created_at', '>=', Carbon::createFromFormat('d/m/Y', request('from')));
                            })
                            ->when(request()->has('to'), function ($q) {
                                $q->where('created_at', '<=', Carbon::createFromFormat('d/m/Y', request('to')));
                            })
                            ->orderBy('created_at', 'desc')
                            ->get();

        return $this->response($enquiries);
    }
}
