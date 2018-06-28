<?php

namespace App\Http\Controllers\Judi;

use App\Http\Controllers\Controller;
use App\Judi\Repositories\ReportRepository;
use App\Judi\Repositories\CriteriaRepository;
use App\Http\Requests\Judi\StoreReportRequest;

class ReportController extends Controller
{
    /**
     * @var ReportRepository
     */
    protected $reports;

    /**
     * @var CriteriaRepository
     */
    private $criteria;

    /**
     * @param ReportRepository   $reports
     * @param CriteriaRepository $criteria
     */
    function __construct(ReportRepository $reports, CriteriaRepository $criteria)
    {
        $this->middleware('judi.admin', ['except' => ['index']]);
        $this->reports = $reports;
        $this->criteria = $criteria;
    }

    /**
     * Display all listings
     */
    public function index()
    {
        return view('judi.reports.index', ['reports' => $this->reports->getAll()]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \App\Core\EntityNotFoundException
     */
    public function show($id)
    {
        return view('judi.reports.show', ['report' => $this->reports->requireById($id)]);
    }

    /**
     * Create a new listing
     */
    public function create()
    {
        return view('judi.reports.create', ['criteria' => $this->criteria->getAll('name')]);
    }

    /**
     * @param StoreReportRequest $request
     * @return mixed
     */
    public function store(StoreReportRequest $request)
    {
        $this->reports->create($request->only('title', 'description', 'criteria_id', 'order'));

        return redirect()->route('judi.reports.index')->with('success', 'You have successfully created a new report');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     * @throws \App\Core\EntityNotFoundException
     */
    public function edit($id)
    {
        return view('judi.reports.edit', [
            'criteria' => $this->criteria->getAll('name'),
            'report' => $this->reports->requireById($id)->load('criteria'),
        ]);
    }

    /**
     * @param StoreReportRequest $request
     * @param                    $id
     * @return mixed
     */
    public function update(StoreReportRequest $request, $id)
    {
        $this->reports->update($id, $request->only('title', 'description', 'criteria'));

        return redirect()->route('judi.reports.index')->with('success', 'You have successfully updated the report.');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->reports->requireById($id)->delete();

        return redirect()->back()->with('success', 'Report has been deleted.');
    }

    /**
     * Returns a listing of trashed departments
     */
    public function getTrashed()
    {
        return view('general.trashed', [
            'collection' => $this->reports->getAllTrashedPaginated(20, 'title'),
            'title' => 'Report',
            'route' => 'judi.reports.restore',
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
        $this->reports->restoreById($id);

        return redirect()->route('judi.reports.index')->with('success', 'You have successfully restored the item.');
    }
}