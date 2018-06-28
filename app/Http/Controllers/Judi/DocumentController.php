<?php

namespace App\Http\Controllers\Judi;

use App\Http\Controllers\Controller;
use App\Judi\Repositories\CriteriaRepository;
use App\Judi\Repositories\DocumentRepository;
use App\Http\Requests\Judi\StoreDocumentRequest;

class DocumentController extends Controller
{
    /**
     * @var CriteriaRepository
     */
    protected $documents;

    /**
     * @param DocumentRepository $documents
     */
    function __construct(DocumentRepository $documents)
    {
        $this->middleware('judi.admin', ['except' => ['index']]);
        $this->documents = $documents;
    }

    /**
     * Display all listings
     */
    public function index()
    {
        return view('judi.documents.index', ['documents' => $this->documents->getAll('title')]);
    }

    /**
     * Create a new listing
     */
    public function create()
    {
        return view('judi.documents.create');
    }

    /**
     * @param StoreDocumentRequest $request
     * @return mixed
     */
    public function store(StoreDocumentRequest $request)
    {
        $this->documents->add($request->only('title', 'number', 'url'));

        return redirect()->route('judi.documents.index')->with('success', 'You have successfully created a new document');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     * @throws \App\Core\EntityNotFoundException
     */
    public function edit($id)
    {
        return view('judi.documents.edit', ['document' => $this->documents->requireById($id)]);
    }

    /**
     * @param StoreDocumentRequest $request
     * @param                      $id
     * @return mixed
     */
    public function update(StoreDocumentRequest $request, $id)
    {
        $this->documents->update($id, $request->only('title', 'number', 'url'));

        return redirect()->route('judi.documents.index')->with('success', 'You have successfully updated the document.');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->documents->requireById($id)->delete();

        return redirect()->back()->with('success', 'Document has been deleted.');
    }

    /**
     * Returns a listing of trashed departments
     */
    public function getTrashed()
    {
        return view('general.trashed', [
            'collection' => $this->documents->getAllTrashedPaginated(20, 'title'),
            'title' => 'Documents',
            'route' => 'judi.documents.restore',
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
        if ( ! $this->documents->restoreById($id)) {
            return redirect()->back()->with('error', 'Sorry, there was an error with this request. Please try again later.');
        }

        return redirect()->route('judi.documents.index')->with('success', 'You have successfully restored the item.');
    }
}