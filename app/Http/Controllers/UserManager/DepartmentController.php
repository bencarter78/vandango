<?php

namespace App\Http\Controllers\UserManager;

use App\Http\Controllers\Controller;
use App\UserManager\Departments\DepartmentRepository;
use App\Http\Requests\UserManager\StoreDepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * @var DepartmentInterface
     */
    private $departments;

    /**
     * @param DepartmentRepository $departments
     */
    public function __construct(DepartmentRepository $departments)
    {
        $this->middleware('auth.isHr', [
            'except' => ['index', 'show'],
        ]);
        
        $this->departments = $departments;
    }

    /**
     * Display a listing of the resource.
     * GET /department
     *
     * @return Response
     */
    public function index()
    {
        return view('usermanager.departments.index', [
            'departments' => $this->departments->getAllPaginated(20, 'department'),
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
        return view('usermanager.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /department
     *
     * @param StoreDepartmentRequest $request
     * @return Response
     */
    public function store(StoreDepartmentRequest $request)
    {
        $this->departments->create($request->all());

        return redirect()->route('departments.index')
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
        return view('usermanager.departments.show', [
            'department' => $this->departments->requireById($id),
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
        return view('usermanager.departments.edit', [
            'department' => $this->departments->requireById($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     * PUT /department/{id}
     *
     * @param  int                   $id
     * @param StoreDepartmentRequest $request
     * @return Response
     */
    public function update($id, StoreDepartmentRequest $request)
    {
        $this->departments->update(
            $id, $request->only('department', 'manager_id', 'ad_id')
        );

        return redirect()->route('departments.index')
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
        $department = $this->departments->requireById($id);
        $department->delete();

        return back()->with('success', 'Department has been deleted.');
    }
}