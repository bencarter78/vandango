<?php

namespace App\Http\Controllers\Blink;

use Carbon\Carbon;
use App\Blink\Models\User;
use Illuminate\Http\Request;
use App\Jobs\Blink\SaveActivity;
use App\Http\Controllers\Controller;
use App\Blink\Repositories\Enquiries;
use App\Events\Blink\AccountManagerWasUpdated;

class EnquiryOwnerController extends Controller
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
        $user = User::findOrFail($request->get('user_id'));
        $enquiry = $this->enquiries->requireById($id);
        $enquiry->addOwner($user, $request->get('updated_by'));
        $enquiry->touch();

        event(new AccountManagerWasUpdated($user, $enquiry));

        dispatch(new SaveActivity($enquiry, [
            'due_at' => Carbon::now()->format('d/m/Y'),
            'note' => 'Enquiry assigned to ' . $user->fullName,
            'updated_by' => $request->get('updated_by'),
        ]));

        return back()->with('success', 'You have successfully updated the enquiry');
    }
}
