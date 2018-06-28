<?php

namespace App\Http\Controllers\Api\V1\Blink;

use Carbon\Carbon;
use App\Blink\Models\User;
use Illuminate\Http\Request;
use App\Jobs\Blink\SaveActivity;
use App\Blink\Models\Opportunity;
use App\Jobs\Blink\ProgressEntity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blink\OpportunityRequest;

class EnquiryOpportunityController extends Controller
{
    /**
     * @param                    $id
     * @param OpportunityRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($id, OpportunityRequest $request)
    {
        $opportunity = Opportunity::create([
            'enquiry_id' => $id,
            'user_id' => $request->user_id,
            'sector_id' => $request->sector_id,
            'quantity' => preg_replace('/[^0-9]/', '', $request->quantity),
            'value' => preg_replace('/[^0-9]/', '', $request->value),
            'expected_on' => Carbon::createFromFormat('d/m/Y', $request->expected_on),
            'programme_type' => $request->programme_type,
        ]);

        $enquiry = $opportunity->enquiry;

        if ($enquiry->hasStatus(config('vandango.blink.statuses.unqualified'))) {
            $this->dispatch(new ProgressEntity($enquiry, $request->user_id));
        }

        $this->dispatch(new SaveActivity($opportunity->enquiry, [
            'due_at' => Carbon::now()->format('d/m/Y'),
            'note' => "New opportunity raised, $opportunity->quantity starts for {$opportunity->sector->name} valued at £$opportunity->value",
            'updated_by' => $request->user_id,
        ]));

        return $this->response($opportunity);
    }

    /**
     * @param         $enquiryId
     * @param         $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($enquiryId, $id, Request $request)
    {
        if (User::findOrFail($request->user_id)->hasAccess('blinkAdmin')) {
            Opportunity::findOrFail($id)->delete();
        }

        return $this->response(['success' => 'You have successfully deleted the opportunity']);
    }
}
