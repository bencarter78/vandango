<?php

namespace App\Http\Controllers\Judi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Judi\Repositories\UserRepository;
use App\Judi\Repositories\ProcessRepository;
use App\Judi\Repositories\AssessmentRepository;

class AssessorController extends Controller
{
    /**
     * @var AssessorInterface|UserInterface
     */
    private $assessors;

    /**
     * @var ProcessInterface
     */
    private $processes;

    /**
     * @var AssessmentInterface
     */
    private $assessments;

    /**
     * @param UserRepository       $assessors
     * @param ProcessRepository    $processes
     * @param AssessmentRepository $assessments
     */
    function __construct(UserRepository $assessors, ProcessRepository $processes, AssessmentRepository $assessments)
    {
        $this->middleware('judi.pa', ['only' => ['show']]);
        $this->assessors = $assessors;
        $this->processes = $processes;
        $this->assessments = $assessments;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('judi.assessors.index', [
            'assessors' => $this->assessors->getUsersByRoleName(config('vandango.judiPaRoleName'))
                                           ->load('departments', 'sectors', 'processes', 'caseload'),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        return view('judi.assessors.edit', [
            'assessor' => $this->assessors->requireById($id),
            'processes' => $this->processes->getAll('name'),
        ]);
    }

    /**
     * @param Request $request
     * @param         $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $this->assessors->updateProcesses($id, $request->get('process_id'));

        return redirect()->route('judi.assessors.index')->with('success', 'You have successfully updated the assessor');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return redirect()->route('judi.assessors.planned', $id);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function planned($id)
    {
        $assessor = $this->assessors->requireById($id);

        return view('judi.assessors.caseload', [
            'assessor' => $assessor,
            'assessments' => $this->assessments->getAssessorCaseload($id, 20),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function submitted($id)
    {
        return view('judi.assessors.caseload', [
            'assessor' => $this->assessors->requireById($id),
            'assessments' => $this->assessments->getAssessorSubmittedAssessments($id, 20),
        ]);
    }

}