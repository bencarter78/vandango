<?php

namespace App\Http\Controllers\Blink;

use App\Http\Controllers\Controller;
use App\Jobs\Blink\PushEnquiryToAccountManager;

class EnquiryVacancyEnableController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index($id)
    {
        dispatch(new PushEnquiryToAccountManager($id));

        return back()->with('success', 'You have successfully forwarded the vacancy data for this enquiry.');
    }
}
