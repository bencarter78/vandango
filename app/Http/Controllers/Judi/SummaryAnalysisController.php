<?php

namespace App\Http\Controllers\Judi;

use App\Judi\Repositories\ProcessRepository;
use App\Judi\Repositories\SectorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Judi\Services\AssessmentSummary;
use App\Judi\Repositories\GradeRepository;
use App\Judi\Repositories\SummaryRepository;
use App\Judi\Repositories\AssessmentRepository;

class SummaryAnalysisController extends Controller
{
    /**
     * @var AssessmentInterface
     */
    private $assessments;

    /**
     * @var GradeRepository
     */
    private $grades;

    /**
     * @var
     */
    protected $summaries;

    /**
     * @var
     */
    private $data;

    /**
     * @param AssessmentRepository $assessments
     * @param GradeRepository      $grades
     * @param SummaryRepository    $summaries
     */
    function __construct(AssessmentRepository $assessments, GradeRepository $grades, SummaryRepository $summaries)
    {
        $this->assessments = $assessments;
        $this->grades = $grades;
        $this->summaries = $summaries;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $grades = $this->grades->getAll();

        if ( ! empty($request->all())) {
            $this->isValid($request);
            $this->setData($request);
            $assessments = $this->assessments->summary($request->all());
            $summaryData = [
                'totals' => $this->assessments->summariseGradeTotals($assessments, $grades),
                'process' => $this->assessments->summariseByProcess($assessments, $grades),
            ];
        }

        return view('judi.analysis.summaries', [
            'data' => $this->data,
            'grades' => $grades,
            'summaryData' => isset($summaryData) ? $summaryData : null,
        ]);
    }

    /**
     * @param $request
     */
    private function isValid($request)
    {
        $this->validate($request, [
            'date_from' => 'required',
            'date_to' => 'required',
            'grade_id' => 'required',
            'process_id' => 'required',
            'sector_id' => 'required',
        ], [
            'date_from.required' => 'The date from field is required',
            'date_to.required' => 'The date to field is required',
            'grade_id.required' => 'At least one grade is required',
            'process_id.required' => 'At least one process is required',
            'sector_id.required' => 'At least one sector is required',
        ]);
    }

    /**
     * @param $request
     */
    private function setData($request)
    {
        $this->data = $this->summaries->filter($request->except('_token'), 20);
    }
}
