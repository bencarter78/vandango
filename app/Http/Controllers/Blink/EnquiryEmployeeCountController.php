<?php

namespace App\Http\Controllers\Blink;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blink\Repositories\Enquiries;

class EnquiryEmployeeCountController extends Controller
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
    public function update($id, Request $request)
    {
        if ($request->has('employee_count')) {
            $this->enquiries->requireById($id)->update(['employee_count' => $request->get('employee_count')]);
        }

        return back()->with('success', 'You have successfully updated the enquiry');
    }
}
