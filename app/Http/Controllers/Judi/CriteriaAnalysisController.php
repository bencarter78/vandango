<?php

namespace App\Http\Controllers\Judi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Judi\Repositories\CriteriaRepository;

class CriteriaAnalysisController extends Controller
{
    /**
     * @var CriteriaRepository
     */
    private $criteria;

    /**
     * @var CriteriaSummary
     */
    private $summary;

    /**
     * CriteriaAnalysisController constructor.
     *
     * @param CriteriaRepository $criteria
     */
    public function __construct(CriteriaRepository $criteria)
    {
        $this->criteria = $criteria;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('judi.analysis.criteria', [
            'data' => $request->all()
                ? $this->criteria->summariseCriteriaGrades($request->all())
                : null,
        ]);
    }
}
