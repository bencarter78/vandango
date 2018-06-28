<?php

namespace App\Http\Controllers\UserManager;

use App\Http\Controllers\Controller;
use App\UserManager\Users\UserRepository;
use App\UserManager\Roles\RoleRepository;
use App\Http\Requests\UserManager\StoreRoleRequest;

class RoleController extends Controller
{
    /**
     * @var RoleInterface
     */
    protected $roles;

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @param RoleRepository $roles
     * @param UserRepository $user
     */
    function __construct(RoleRepository $roles, UserRepository $user)
    {
        $this->middleware('auth.isHr');
        $this->roles = $roles;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     * GET /department
     *
     * @return Response
     */
    public function index()
    {
        return view('usermanager.roles.index', [
            'roles' => $this->roles->getAllPaginated(20, 'job_role'),
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
        return view('usermanager.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /department
     *
     * @param StoreRoleRequest $request
     * @return Response
     */
    public function store(StoreRoleRequest $request)
    {
        $this->roles->create($request->all());

        return redirect()->route('roles.index')
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
        return view('usermanager.roles.show', [
            'role' => $this->roles->getRoleStaff($id),
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
        return view('usermanager.roles.edit', [
            'role' => $this->roles->requireById($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     * PUT /department/{id}
     *
     * @param  int             $id
     * @param StoreRoleRequest $request
     * @return Response
     */
    public function update($id, StoreRoleRequest $request)
    {
        $this->roles->update($id, $request->only('job_role'));

        return redirect()->route('roles.index')
                         ->with('success', 'You have successfully updated this job role');
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
        $department = $this->roles->requireById($id);
        $department->delete();

        return back()->with('success', 'Role has been deleted.');
    }

    /**
     * Restores a trashed user
     *
     * @param $id
     * @return mixed
     */
    public function restore($id)
    {
        $role = $this->roles->restoreById($id);

        if ( ! $role) {
            return back()->with('error', 'Sorry, there was an error with this request. Please try again later.');
        }

        return redirect()->route('roles.index')
                         ->with('success', 'You have successfully restored the job role.');
    }

    /**
     * Returns a listing of trashed users
     */
    public function getTrashed()
    {
        return view('usermanager.roles.trashed', [
            'roles' => $this->roles->getAllTrashedPaginated(20, 'job_role'),
        ]);
    }

}