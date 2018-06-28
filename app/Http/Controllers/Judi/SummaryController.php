<?php

namespace App\Http\Controllers\Judi;

use Illuminate\Http\Request;
use App\Judi\Models\Summary;
use Illuminate\Http\Response;
use App\Jobs\Judi\SaveSummary;
use App\Http\Controllers\Controller;
use App\Jobs\Judi\SubmitAssessmentSummary;
use App\Judi\Repositories\ReportRepository;
use App\Judi\Repositories\SummaryRepository;
use App\Exceptions\SummaryIncompleteException;
use App\Judi\Repositories\AssessmentRepository;
use App\Events\Judi\SummaryOutcomeWasSubmitted;
use App\Http\Requests\Judi\StoreSummaryRequest;

class SummaryController extends Controller
{
    /**
     * @var AssessmentInterface
     */
    private $assessments;

    /**
     * @var ReportRepository
     */
    private $reports;

    /**
     * @var SummaryRepository
     */
    private $summaries;

    /**
     * @param SummaryRepository    $summaries
     * @param AssessmentRepository $assessments
     * @param ReportRepository     $reports
     */
    function __construct(SummaryRepository $summaries, AssessmentRepository $assessments, ReportRepository $reports)
    {
        $this->middleware('judi.pa', ['except' => ['show', 'outcome', 'getDocumentation']]);
        $this->summaries = $summaries;
        $this->assessments = $assessments;
        $this->reports = $reports;
    }

    /**
     * Create a summary
     *
     * @param Request $request
     * @return \Illuminate\View\View
     * @throws \App\Core\EntityNotFoundException
     */
    public function create(Request $request)
    {
        $report = $this->reports->requireById($request->segment(5));

        return view('judi.summaries.create', [
            'assessment' => $this->assessments->requireById($request->segment(4)),
            'report' => $report,
            'criterion' => $report->criteria,
        ]);
    }

    /**
     * @param StoreSummaryRequest $request
     * @return mixed
     * @throws SummaryIncompleteException
     */
    public function store(StoreSummaryRequest $request)
    {
        $summary = $this->dispatch(new SaveSummary($request->except('_token', 'submit', 'save')));

        return $this->saveOrSubmit($request, $summary);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     * @throws \App\Core\EntityNotFoundException
     */
    public function show($id)
    {
        return view('judi.summaries.show', ['summary' => $this->summaries->requireById($id, true)]);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $summary = $this->summaries->requireById($id, true);
        
        return view('judi.summaries.edit', [
            'summary' => $summary,
            'criterion' => $summary->report->criteria,
        ]);
    }

    /**
     * @param                     $id
     * @param StoreSummaryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws SummaryIncompleteException
     */
    public function update($id, StoreSummaryRequest $request)
    {
        $summary = dispatch(new SaveSummary(
            $request->except('_token', 'submit', 'save'),
            $this->summaries->requireById($id, true)
        ));

        return $this->saveOrSubmit($request, $summary);
    }

    /**
     * @param StoreSummaryRequest $request
     * @param Summary             $summary
     * @return \Illuminate\Http\RedirectResponse
     */
    private function saveOrSubmit(StoreSummaryRequest $request, Summary $summary)
    {
        if ($request->has('submit')) {
            try {
                dispatch(new SubmitAssessmentSummary($summary, $request));
            } catch (SummaryIncompleteException $e) {
                return redirect()->route('judi.summaries.edit', $summary->id)
                                 ->withInput()
                                 ->with('error', $e->getMessage());
            }
        }

        return redirect()->route('judi.assessors.show', $summary->assessment->assessor_id)
                         ->with('success', $request->has('save')
                             ? 'You have successfully saved your Report Summary.'
                             : 'You have successfully submitted your Process Report Summary to the Performance Assessment team.'
                         );
    }
}