<?php

namespace App\Http\Controllers\Api\V1\Blink;

use App\Blink\Models\Department;
use App\Blink\Summary\UserSummary;
use App\Http\Controllers\Controller;
use App\Blink\Repositories\Enquiries;
use App\Blink\Repositories\Departments;
use App\Blink\Summary\DepartmentSummary;

class DepartmentController extends Controller
{
    /**
     * @var Enquiries
     */
    protected $enquiries;

    /**
     * @var Departments
     */
    private $departments;

    /**
     * @var UserSummary
     */
    private $users;

    /**
     * DepartmentController constructor.
     *
     * @param Enquiries         $enquiries
     * @param DepartmentSummary $departments
     * @param UserSummary       $users
     */
    public function __construct(Enquiries $enquiries, DepartmentSummary $departments, UserSummary $users)
    {
        $this->enquiries = $enquiries;
        $this->departments = $departments;
        $this->users = $users;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->response($this->departments->setEnquiries($this->getEnquiries())->summarise(Department::all()));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->response($this->users->setEnquiries($this->getEnquiries())->summarise(Department::findOrFail($id)->users));
    }

    /**
     * @return mixed
     */
    private function getEnquiries()
    {
        return $this->enquiries->getAll('id', 'asc', ['applicants', 'opportunities', 'owners', 'owners.departments', 'vacancies']);
    }
}
