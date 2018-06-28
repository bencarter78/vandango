<?php

namespace App\Http\Controllers\Judi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Judi\Repositories\UserRepository;
use App\Judi\Repositories\SectorRepository;
use App\Judi\Repositories\AssessmentRepository;

class SectorController extends Controller
{
    /**
     * @var SectorInterface
     */
    protected $sectors;

    /**
     * @var UserInterface
     */
    private $users;

    /**
     * @var AssessmentInterface
     */
    private $assessments;

    /**
     * @param SectorRepository     $sectors
     * @param UserRepository       $users
     * @param AssessmentRepository $assessments
     */
    function __construct(SectorRepository $sectors, UserRepository $users, AssessmentRepository $assessments)
    {
        $this->sectors = $sectors;
        $this->users = $users;
        $this->assessments = $assessments;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('judi.sectors.index');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return redirect()->route('judi.sectors.planned', $id);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        Session::flash('url', URL::previous());

        return view('judi.sectors.edit', ['sector' => $this->sectors->requireById($id)]);
    }

    /**
     * @param Request $request
     * @param         $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $this->sectors->saveScheduledMonth($id, $request->get('month'));
        $url = Session::has('url') ? Session::get('url') : 'judi/sectors';

        return redirect()->to($url)->with('success', 'You have successfully updated the sector');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     * @throws \App\Core\EntityNotFoundException
     */
    public function planned($id)
    {
        return view('judi.sectors.show', [
            'assessments' => $this->assessments->getAssessmentsBySector($id, null, 20),
            'sector' => $this->sectors->requireById($id),
            'title' => 'Planned Assessments',
            'users' => $this->users->getUsersBySector($id)->load('meta', 'roles', 'roles.processes'),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     * @throws \App\Core\EntityNotFoundException
     */
    public function submitted($id)
    {
        return view('judi.sectors.show', [
            'assessments' => $this->assessments->getAssessmentsBySector($id, true, 20),
            'sector' => $this->sectors->requireById($id),
            'title' => 'Submitted Assessments',
            'users' => $this->users->getUsersBySector($id)->load('meta', 'roles', 'roles.processes'),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     * @throws \App\Core\EntityNotFoundException
     */
    public function staff($id)
    {
        return view('judi.sectors.show', [
            'sector' => $this->sectors->requireById($id),
            'title' => 'Linked Staff',
            'users' => $this->users->getUsersBySector($id)->load('meta', 'roles', 'roles.processes'),
        ]);
    }
}