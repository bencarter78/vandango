<?php

namespace App\Http\Controllers\Api\V1\Blink;

use Illuminate\Http\Request;
use App\Blink\Models\Contact;
use App\Blink\Models\Enquiry;
use Tck\HumanNameParser\Parser;
use App\Http\Controllers\Controller;

class EnquiryContactController extends Controller
{
    /**
     * @param         $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'organisation_id' => 'required',
            'name' => 'required',
            'tel' => 'required_without:email',
            'email' => 'nullable|email|required_without:tel',
        ]);

        $name = new Parser($request->name);

        $contact = Contact::updateOrCreate(['id' => $request->get('id')], [
            'organisation_id' => $request->organisation_id,
            'first_name' => $name->firstName(),
            'surname' => $name->surname(),
            'job_title' => $request->job_title,
            'tel' => $request->tel,
            'email' => $request->email,
        ]);

        Enquiry::findOrFail($id)->update(['contact_id' => $contact->id]);

        return $this->response($contact);
    }
}
