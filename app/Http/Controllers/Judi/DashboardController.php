<?php

namespace App\Http\Controllers\Judi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Judi\Repositories\GradeRepository;
use App\Judi\Repositories\SummaryRepository;
use App\Judi\Repositories\AssessmentRepository;

class DashboardController extends Controller
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
        $user = Auth::user();
        $grades = $this->grades->getAll();

        if ($user->hasAccess('judiAdmin')) {
            $data = $this->getAdminData($request);

            if ($request->all()) {
                $assessments = $this->assessments->summary($request->all());
                $summaryData = [
                    'totals' => $this->assessments->summariseGradeTotals($assessments, $grades),
                    'process' => $this->assessments->summariseByProcess($assessments, $grades),
                ];
            }
        } elseif ($user->hasAccess('judiSM')) {
            $data = $this->getManagerData($user);
        }

        return view('judi.dashboard', [
            'data' => isset($data) ? $data : null,
            'grades' => $grades,
            'summaryData' => isset($summaryData) ? $summaryData : null,
        ]);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAdminData($request)
    {
        if ($request->all()) {
            $this->validate($request,
                [
                    'date_from' => 'required',
                    'date_to' => 'required',
                    'grade_id' => 'required',
                    'process_id' => 'required',
                    'sector_id' => 'required',
                ],
                [
                    'date_from.required' => 'The date from field is required',
                    'date_to.required' => 'The date to field is required',
                    'grade_id.required' => 'At least one grade is required',
                    'process_id.required' => 'At least one process is required',
                    'sector_id.required' => 'At least one sector is required',
                ]);

            return $this->summaries->filter($request->except('_token'), 20);
        }
    }

    /**
     * @param $user
     * @return mixed
     */
    public function getManagerData($user)
    {
        return $this->summaries->getSubStandardSectorSummaries($user->sectors->pluck('id')->all());
    }

    /**
     * @return mixed
     */
    public function getAssessments()
    {
        return view('assessments.index', [
            'assessments' => $this->assessments->getAllPaginated(20, 'assessment_date'),
        ]);
    }

}
