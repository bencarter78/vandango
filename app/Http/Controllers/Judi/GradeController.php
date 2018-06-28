<?php

namespace App\Http\Controllers\Judi;

use App\Http\Controllers\Controller;
use App\Judi\Repositories\GradeRepository;
use App\Http\Requests\Judi\StoreGradeRequest;

class GradeController extends Controller
{
    /**
     * @var GradeRepository
     */
    protected $grades;

    /**
     * @param GradeRepository $grades
     */
    function __construct(GradeRepository $grades)
    {
        $this->middleware('judi.admin', ['except' => ['index']]);
        $this->grades = $grades;
    }

    /**
     * Display all listings
     */
    public function index()
    {
        return view('judi.grades.index', ['grades' => $this->grades->getAll()]);
    }

    /**
     * Create a new listing
     */
    public function create()
    {
        return view('judi.grades.create');
    }

    /**
     * @param StoreGradeRequest $request
     * @return mixed
     */
    public function store(StoreGradeRequest $request)
    {
        $this->grades->add($request->only('name'));

        return redirect()->route('judi.grades.index')->with('success', 'You have successfully created a new grade');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     * @throws \App\Core\EntityNotFoundException
     */
    public function edit($id)
    {
        return view('judi.grades.edit', ['grade' => $this->grades->requireById($id)]);
    }

    /**
     * @param StoreGradeRequest $request
     * @param                   $id
     * @return mixed
     */
    public function update(StoreGradeRequest $request, $id)
    {
        $this->grades->update($id, $request->only('name'));

        return redirect()->route('judi.grades.index')->with('success', 'You have successfully updated the grade.');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->grades->requireById($id)->delete();

        return redirect()->back()->with('success', 'Grade has been deleted.');
    }

    /**
     * Returns a listing of trashed departments
     */
    public function getTrashed()
    {
        return view('general.trashed', [
            'collection' => $this->grades->getAllTrashedPaginated(20, 'name'),
            'title' => 'Grade',
            'route' => 'judi.grades.restore',
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
        $this->grades->restoreById($id);

        return redirect()->route('judi.grades.index')->with('success', 'You have successfully restored the item.');
    }
}