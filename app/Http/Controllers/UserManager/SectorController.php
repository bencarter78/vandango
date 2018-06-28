<?php

namespace App\Http\Controllers\UserManager;

use App\Http\Controllers\Controller;
use App\UserManager\Sectors\SectorRepository;
use App\Http\Requests\UserManager\StoreSectorRequest;

class SectorController extends Controller
{
    /**
     * @var SectorInterface
     */
    protected $sectors;

    /**
     * @param SectorRepository $sectors
     */
    function __construct(SectorRepository $sectors)
    {
        $this->middleware('auth.isHr', [
            'except' => ['index', 'show'],
        ]);

        $this->sectors = $sectors;
    }

    /**
     * Display a listing of the resource.
     * GET /department
     *
     * @return Response
     */
    public function index()
    {
        return view('usermanager.sectors.index', [
            'sectors' => $this->sectors->getAllPaginated(20, 'name'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * GET /department/create
     *
     * @return Response
     */
    public function create()
    {
        return view('usermanager.sectors.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /department
     *
     * @param StoreSectorRequest $request
     * @return Response
     */
    public function store(StoreSectorRequest $request)
    {
        $this->sectors->create(
            $request->only('code', 'name', 'department_id')
        );

        return redirect()->route('sectors.index')
                         ->with('success', 'You have successfully created a new department.');
    }

    /**
     * Display the specified resource.
     * GET /department/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return view('usermanager.sectors.show', [
            'sector' => $this->sectors->getSectorStaff($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * GET /department/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('usermanager.sectors.edit', [
            'sector' => $this->sectors->requireById($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     * PUT /department/{id}
     *
     * @param  int               $id
     * @param StoreSectorRequest $request
     * @return Response
     */
    public function update($id, StoreSectorRequest $request)
    {
        $this->sectors->update($id, $request->only('code', 'name', 'department_id'));

        return redirect()->route('sectors.index')
                         ->with('success', 'You have successfully updated the department');

    }

    /**
     * Remove the specified resource from storage.
     * DELETE /department/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $department = $this->sectors->requireById($id);
        $department->delete();

        return redirect()->back()->with('success', 'Sector has been deleted.');
    }

    /**
     * Restores a trashed user
     *
     * @param $id
     * @return mixed
     */
    public function restore($id)
    {
        if ( ! $this->sectors->restoreById($id)) {
            return redirect()->back()->with('error', 'Sorry, there was an error with this request. Please try again later.');
        }

        return redirect()->route('sectors.index')->with('success', 'You have successfully restored the sector.');
    }
}