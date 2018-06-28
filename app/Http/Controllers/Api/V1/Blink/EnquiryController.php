<?php

namespace App\Http\Controllers\Api\V1\Blink;

use App\Blink\Models\Status;
use App\Http\Controllers\Controller;
use App\Blink\Repositories\Enquiries;
use App\Jobs\Blink\SaveEnquiryDetails;
use App\Http\Requests\Blink\ApiEnquiryRequest;

class EnquiryController extends Controller
{
    /**
     * @var Enquiries
     */
    protected $enquiries;

    /**
     * EnquiryController constructor.
     *
     * @param $enquiries
     */
    public function __construct(Enquiries $enquiries)
    {
        $this->enquiries = $enquiries;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enquiries = $this->enquiries->getLive();

        return response()->json([
            'ok' => true,
            'total' => $enquiries->count(),
            'results' => $enquiries,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ApiEnquiryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApiEnquiryRequest $request)
    {
        $request->merge([
            'contact_name' => $request->contact_search,
            'organisation_name' => $request->organisation_search,
            'location' => $request->organisation_location,
            'updated_by' => $request->user_id,
            'status_id' => Status::whereName(config('vandango.blink.enquiries.pending'))->first()->id,
        ]);

        $this->dispatch(new SaveEnquiryDetails($request->all()));

        return response()->json(['ok' => true], 200);
    }
}
