<?php

namespace App\Http\Controllers\Blink;

use App\Blink\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blink\Repositories\Enquiries;

class EnquiryStatusController extends Controller
{
    /**
     * @var Enquiries
     */
    protected $enquiries;

    /**
     * EnquiryOwnerController constructor.
     *
     * @param $enquiries
     */
    public function __construct(Enquiries $enquiries)
    {
        $this->enquiries = $enquiries;
    }

    /**
     * @param         $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($id, Request $request)
    {
        $enquiry = $this->enquiries->requireById($id);
        $enquiry->addStatus(Status::findOrFail($request->get('status_id')), $request->get('updated_by'));
        $enquiry->touch();

        return back()->with('success', 'You have successfully updated the enquiry');
    }
}
