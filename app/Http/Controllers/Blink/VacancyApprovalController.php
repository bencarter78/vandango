<?php

namespace App\Http\Controllers\Blink;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blink\Repositories\Vacancies;
use App\Jobs\Blink\ProcessVacancyApprovalDecision;

class VacancyApprovalController extends Controller
{
    /**
     * @var Vacancies
     */
    protected $vacancies;

    /**
     * VacancyApprovalController constructor.
     *
     * @param $vacancies
     */
    public function __construct(Vacancies $vacancies)
    {
        $this->vacancies = $vacancies;
    }

    /**
     * @param         $id
     * @param Request $request
     * @return mixed
     */
    public function update($id, Request $request)
    {
        $vacancy = $this->vacancies->requireById($id);
        $this->authorize('update', $vacancy);
        dispatch(new ProcessVacancyApprovalDecision($request->all(), $vacancy));

        return redirect()
            ->route('blink.enquiries.edit', $vacancy->enquiry_id)
            ->with('success', 'You have successfully updated the vacancy.');
    }
}
