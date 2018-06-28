<?php

namespace App\Http\Controllers\Judi;

use App\Http\Controllers\Controller;
use App\Judi\Repositories\CriteriaRepository;
use App\Http\Requests\Judi\StoreCriteriaRequest;

class CriteriaController extends Controller
{
    /**
     * @var CriteriaRepository
     */
    protected $criteria;

    /**
     * @param CriteriaRepository $criteria
     */
    function __construct(CriteriaRepository $criteria)
    {
        $this->middleware('judi.admin', ['except' => ['index']]);
        $this->criteria = $criteria;
    }

    /**
     * Display all listings
     */
    public function index()
    {
        return view('judi.criteria.index', ['criteria' => $this->criteria->getAll('name')]);
    }

    /**
     * Create a new listing
     */
    public function create()
    {
        return view('judi.criteria.create');
    }

    /**
     * @param StoreCriteriaRequest $request
     * @return mixed
     */
    public function store(StoreCriteriaRequest $request)
    {
        $this->criteria->add($request->only('name', 'description'));

        return redirect()->route('judi.criteria.index')->with('success', 'You have successfully created a new criteria');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     * @throws \App\Core\EntityNotFoundException
     */
    public function edit($id)
    {
        return view('judi.criteria.edit', ['criteria' => $this->criteria->requireById($id)]);
    }

    /**
     * @param StoreCriteriaRequest $request
     * @param                      $id
     * @return mixed
     */
    public function update(StoreCriteriaRequest $request, $id)
    {
        $this->criteria->update($id, $request->only('name', 'description'));

        return redirect()->route('judi.criteria.index')->with('success', 'You have successfully updated the criteria.');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->criteria->requireById($id)->delete();

        return redirect()->back()->with('success', 'Criteria has been deleted.');
    }

    /**
     * Returns a listing of trashed departments
     */
    public function getTrashed()
    {
        return view('general.trashed', [
            'collection' => $this->criteria->getAllTrashedPaginated(20, 'name'),
            'title' => 'Criteria',
            'route' => 'judi.criteria.restore',
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
        if ( ! $this->criteria->restoreById($id)) {
            return redirect()->back()->with('error', 'Sorry, there was an error with this request. Please try again later.');
        }

        return redirect()->route('judi.criteria.index')->with('success', 'You have successfully restored the item.');
    }


}