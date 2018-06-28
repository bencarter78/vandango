<?php

namespace App\Http\Controllers\Blink;

use App\Jobs\Blink\SaveActivity;
use App\Http\Controllers\Controller;
use App\Blink\Repositories\Enquiries;
use App\Events\Blink\EnquiryWasCompleted;
use App\Http\Requests\Blink\ActivityRequest;
use App\Jobs\Blink\UpdateAccountManagerWithNewEnquiryActivity;

class EnquiryActivityController extends Controller
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
     * @param                 $id
     * @param ActivityRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($id, ActivityRequest $request)
    {
        $enquiry = $this->enquiries->requireById($id);

        $this->dispatch(new SaveActivity($enquiry, $request->all()));

        $enquiry->touch();

        $enquiry->statuses()->attach($request->get('status_id'), ['updated_by' => $request->get('updated_by')]);

        if ($request->has('conclusion_id')) {
            $enquiry->update(['conclusion_id' => $request->get('conclusion_id')]);
            event(new EnquiryWasCompleted($enquiry));
            $enquiry->delete();
        }

        if ($enquiry->owners->count() > 0 && $request->updated_by != $enquiry->owners->last()->id) {
            $this->dispatch(new UpdateAccountManagerWithNewEnquiryActivity($enquiry));
        }

        return back()->with('success', 'You have successfully updated the enquiry');
    }
}
