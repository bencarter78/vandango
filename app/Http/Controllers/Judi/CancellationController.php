<?php

namespace App\Http\Controllers\Judi;

use App\Http\Controllers\Controller;
use App\Judi\Repositories\CancellationRepository;
use App\Http\Requests\Judi\StoreCancellationRequest;

class CancellationController extends Controller
{
    /**
     * @var CancellationRepository
     */
    protected $cancellations;

    /**
     * @param CancellationRepository $cancellations
     */
    function __construct(CancellationRepository $cancellations)
    {
        $this->middleware('judi.admin');
        $this->cancellations = $cancellations;
    }

    /**
     * Display all listings
     */
    public function index()
    {
        return view('judi.cancellations.index', ['cancellations' => $this->cancellations->getAll()]);
    }

    /**
     * Create a new listing
     */
    public function create()
    {
        return view('judi.cancellations.create');
    }

    /**
     * @param StoreCancellationRequest $request
     * @return mixed
     */
    public function store(StoreCancellationRequest $request)
    {
        $this->cancellations->add($request->only('type'));

        return redirect()->route('judi.cancellations.index')->with('success', 'You have successfully created a new cancellation reason');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('judi.cancellations.edit', ['cancellation' => $this->cancellations->requireById($id)]);
    }

    /**
     * @param StoreCancellationRequest $request
     * @param                          $id
     * @return mixed
     */
    public function update(StoreCancellationRequest $request, $id)
    {
        $this->cancellations->update($id, $request->only('type'));

        return redirect()->route('judi.cancellations.index')
                         ->with('success', 'You have successfully updated the grade.');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->cancellations->requireById($id)->delete();

        return redirect()->back()->with('success', 'Cancellation has been deleted.');
    }

    /**
     * Returns a listing of trashed departments
     */
    public function getTrashed()
    {
        return view('general.trashed', [
            'collection' => $this->cancellations->getAllTrashedPaginated(20, 'type'),
            'title' => 'Cancellation',
            'route' => 'judi.cancellations.restore',
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
        if ( ! $this->cancellations->restoreById($id)) {
            return redirect()->back()->with('error', 'Sorry, there was an error with this request. Please try again later.');
        }

        return redirect()->route('judi.cancellations.index')->with('success', 'You have successfully restored the item.');
    }
}