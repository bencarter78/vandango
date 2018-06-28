<?php

namespace App\Http\Controllers\Judi;

use App\Http\Controllers\Controller;
use App\Judi\Repositories\ReportRepository;
use App\Judi\Repositories\ProcessRepository;
use App\Http\Requests\Judi\StoreProcessRequest;
use App\Judi\Repositories\AssessmentRepository;

class ProcessController extends Controller
{
    /**
     * @var ProcessInterface
     */
    private $processes;

    /**
     * @var ReportRepository
     */
    private $reports;

    /**
     * @param ProcessRepository $processes
     * @param ReportRepository  $reports
     */
    function __construct(ProcessRepository $processes, ReportRepository $reports)
    {
        $this->middleware('judi.admin', ['except' => ['index']]);
        $this->processes = $processes;
        $this->reports = $reports;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('judi.processes.index', ['processes' => $this->processes->getAllPaginated(20, 'name')]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('judi.processes.create', ['reports' => $this->reports->getAll('title')]);
    }

    /**
     * @param StoreProcessRequest $request
     * @return mixed
     */
    public function store(StoreProcessRequest $request)
    {
        $this->processes->create($request->only('name', 'trigger_week', 'role_id'));

        return redirect()->route('judi.processes.index')->with('success', 'You have successfully created a new process');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        return view('judi.processes.edit', [
            'process' => $this->processes->requireById($id),
            'reports' => $this->reports->getAll('title'),
        ]);
    }

    /**
     * @param StoreProcessRequest $request
     * @param                     $id
     * @return mixed
     */
    public function update(StoreProcessRequest $request, $id)
    {
        $this->processes->update($id, $request->only(['name', 'trigger_week']));

        return redirect()->route('judi.processes.index')->with('success', 'You have successfully updated the process');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $process = $this->processes->requireById($id);
        $process->assessments
            ->each(function ($a) {
                if ($a->summary) {
                    $a->summary->forceDelete();
                }
                $a->forceDelete();
            });
        $process->delete();

        return redirect()->back()->with('success', 'Process has been deleted.');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getTrashed()
    {
        return view('general.trashed', [
            'collection' => $this->processes->getAllTrashedPaginated(20, 'name'),
            'title' => 'Process',
            'route' => 'judi.processes.restore',
        ]);
    }

    /**
     * Restores a from trash
     *
     * @param $id
     * @return mixed
     */
    public function restore($id)
    {
        if ( ! $this->processes->restoreById($id)) {
            return redirect()->back()->with('error', 'Sorry, there was an error with this request. Please try again later.');
        }

        return redirect()->route('judi.processes.index', ['success' => 'You have successfully restored the process.']);
    }

}
