<?php

namespace App\Http\Controllers\Judi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Judi\Repositories\UserRepository;
use App\Judi\Repositories\SectorRepository;
use App\Judi\Repositories\ProcessRepository;
use App\Judi\Repositories\AssessmentRepository;
use App\Http\Requests\Judi\StoreAssessmentRequest;

class AssessmentController extends Controller
{
    /**
     * @var AssessmentInterface
     */
    private $assessments;

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var SectorRepository
     */
    private $sectors;

    /**
     * @var ProcessRepository
     */
    private $processes;

    /**
     * @param AssessmentRepository $assessments
     * @param ProcessRepository    $processes
     * @param SectorRepository     $sectors
     * @param UserRepository       $users
     */
    function __construct(
        AssessmentRepository $assessments,
        ProcessRepository $processes,
        SectorRepository $sectors,
        UserRepository $users
    ) {
        $this->middleware('judi.admin', ['only' => ['index']]);
        $this->middleware('judi.pa', ['only' => ['show', 'create', 'store', 'edit', 'update', 'user']]);
        $this->middleware('judi.canEditAssessment', ['only' => ['edit', 'update']]);
        $this->assessments = $assessments;
        $this->users = $users;
        $this->sectors = $sectors;
        $this->processes = $processes;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('judi.assessments.index', [
            'assessments' => $this->assessments->getAllPaginated(20, 'assessment_date'),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return view('judi.assessments.show', ['assessment' => $this->assessments->requireById($id)]);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        Session::flash('url', URL::previous());
        $assessment = $this->assessments->requireById($id);

        return view('judi.assessments.edit', [
            'assessment' => $assessment,
            'assessors' => $this->users->getProcessAssessors($assessment->process_id),
        ]);
    }

    /**
     * @param StoreAssessmentRequest $request
     * @param                        $id
     * @return mixed
     */
    public function update(StoreAssessmentRequest $request, $id)
    {
        $this->assessments->update($id, $request->only('assessor_id', 'assessment_date'));

        if (Session::has('url')) {
            return redirect()->to(Session::get('url'))->with('success', 'You have successfully updated this assessment.');
        }

        return redirect()->route('judi.assessments.index')->with('success', 'You have successfully updated this assessment.');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        if ($request->has('sector')) {
            $sectorId = $request->get('sector');
            $sector = $this->sectors->requireById($sectorId);
            $staff = $this->users->getUsersBySector($sectorId)->load('meta', 'roles', 'roles.processes');
        } else {
            $sector = null;
            $staff = $this->users->getStaff('name');
        }

        return view('judi.assessments.create', [
            'assessors' => $this->users->getUsersByRoleName(config('vandango.judiPaRoleName')),
            'processes' => $this->processes->getAll('name'),
            'sector' => $sector,
            'staff' => $staff,
            'user' => $request->has('user') ? $request->get('user') : null,
        ]);
    }

    /**
     * @param StoreAssessmentRequest $request
     * @return mixed
     */
    public function store(StoreAssessmentRequest $request)
    {
        $this->assessments->createManually(
            $request->only('user_id', 'assessor_id', 'assessment_date', 'process_id', 'sector_id', 'is_reassessment')
        );

        return redirect()->route('judi.assessments.create', ['sector' => $request->get('sector_id')])
                         ->with('success', 'You have successfully updated this assessment.');
    }

    /**
     * @param                        $id
     * @param StoreAssessmentRequest $request
     * @return mixed
     */
    public function destroy($id, StoreAssessmentRequest $request)
    {
        try {
            $this->assessments->destroy($id, $request->only('cancellation_id'));

            return redirect()->back()->with('success', 'Assessment has been deleted.');
        } catch (FormValidationException $e) {
            return redirect()->back()->with('error', 'The assessment was not deleted. Please provide a reason as to why you are deleting the assessment.');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function userPlanned($id)
    {
        return view('judi.assessments.user', [
            'assessments' => $this->assessments->getAssessmentsByUser($id, null, 20),
            'user' => $this->users->requireById($id),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function userSubmitted($id)
    {
        return view('judi.assessments.user', [
            'assessments' => $this->assessments->getAssessmentsByUser($id, true, 20),
            'user' => $this->users->requireById($id),
        ]);
    }

}