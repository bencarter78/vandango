<?php

namespace App\Http\Controllers\Judi;

use App\Events\Judi\SummaryOutcomeWasSubmitted;
use App\Judi\Repositories\SummaryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SummaryOutcomeController extends Controller
{
    /**
     * @var SummaryRepository
     */
    protected $summaries;

    /**
     * SummaryOutcomeController constructor.
     *
     * @param $summaries
     */
    public function __construct(SummaryRepository $summaries)
    {
        $this->summaries = $summaries;
    }

    /**
     * @param         $summaryId
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Core\EntityNotFoundException
     */
    public function update($summaryId, Request $request)
    {
        $this->validate($request, ['outcome' => 'required']);
        $summary = $this->summaries->requireById($summaryId, true);
        $summary->update(['outcome' => $request->get('outcome')]);
        event(new SummaryOutcomeWasSubmitted($summary));

        return redirect()->back()->with('success', 'You have successfully updated the outcome');
    }
}
