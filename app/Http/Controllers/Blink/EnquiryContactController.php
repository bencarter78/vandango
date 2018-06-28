<?php

namespace App\Http\Controllers\Blink;

use Illuminate\Http\Request;
use App\Jobs\Blink\SaveContact;
use App\Http\Controllers\Controller;
use App\Blink\Repositories\Enquiries;

class EnquiryContactController extends Controller
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

        $request->merge([
            'contact_name' => $request->get('search')['contact_id'],
            'enquiry_id' => $id,
            'organisation' => $enquiry->contact->organisation,
        ]);

        $contact = dispatch(new SaveContact($request->all()));

        $enquiry->update(['contact_id' => $contact->id]);

        return back()->with('success', 'You have successfully updated the enquiry');
    }
}
