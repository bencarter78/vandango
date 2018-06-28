<?php

namespace App\Http\Controllers\Blink;

use Illuminate\Http\Request;
use App\Blink\Models\Enquiry;
use App\Ignite\Models\Campaign;
use App\Jobs\Blink\SaveActivity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EnquiryCampaignController extends Controller
{
    /**
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->update(['campaign_id' => $request->campaign_id]);

        dispatch(new SaveActivity($enquiry, [
            'note' => Auth::user()->fullName . ' assigned it to the ' . Campaign::findOrFail($request->campaign_id)->name . ' campaign.',
        ]));

        return back()->with('success', 'You have successfully updated the enquiry');
    }
}
