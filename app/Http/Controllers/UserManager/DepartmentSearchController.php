<?php

namespace App\Http\Controllers\UserManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserManager\Departments\DepartmentRepository;

class DepartmentSearchController extends Controller
{
    /**
     * @var
     */
    private $departments;

    /**
     * DepartmentSearchController constructor.
     *
     * @param $departments
     */
    public function __construct(DepartmentRepository $departments)
    {
        $this->departments = $departments;
    }

    /**
     * @param Request $request
     * @return View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        if ($request->has('q')) {
            $departments = $this->departments->searchByNamePaginated($request->get('q'), 20);

            if ($departments->count() > 0) {
                return view('usermanager.departments.index', [
                    'departments' => $departments,
                    'search' => $request->get('q'),
                ]);
            }

            return back()->with('error', 'Sorry, nothing matches your search. Please try again');
        }
    }
}
