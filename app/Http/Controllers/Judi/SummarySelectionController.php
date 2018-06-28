<?php

namespace App\Http\Controllers\Judi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Judi\Repositories\ReportRepository;
use App\Judi\Repositories\AssessmentRepository;

class SummarySelectionController extends Controller
{
    /**
     * @var AssessmentRepository
     */
    protected $assessments;

    /**
     * @var ReportRepository
     */
    protected $reports;

    /**
     * SummarySelectionController constructor.
     *
     * @param AssessmentRepository $assessments
     * @param ReportRepository     $reports
     */
    public function __construct(AssessmentRepository $assessments, ReportRepository $reports)
    {
        $this->assessments = $assessments;
        $this->reports = $reports;
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     * @throws \App\Core\EntityNotFoundException
     */
    public function index($id)
    {
        $assessment = $this->assessments->requireById($id);

        // Has the assessment been linked to a report
        if ($assessment->process->reports->count() == 0) {
            return redirect()->back()
                             ->with('error', 'The assessment type you are trying to summarise has not been linked with a Process Report. Please speak to the Performance Assessment Team.');
        }

        if ($assessment->process->reports->count() == 1) {
            $reportId = $assessment->process->reports->first()->id;
            $report = $this->reports->requireById($reportId);

            return redirect()->to("judi/summaries/create/{$assessment->id}/{$report->id}");
        }

        return view('judi.summaries.select', ['assessment' => $assessment]);
    }

    /**
     * Determine the process type report to use for the assessment
     *
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->has(['report_id', 'assessment_id'])) {
            $reportId = $request->get('report_id');
            $assessmentId = $request->get('assessment_id');

            return redirect()->to("judi/summaries/create/{$assessmentId}/{$reportId}");
        }

        return redirect()->back();
    }
}
