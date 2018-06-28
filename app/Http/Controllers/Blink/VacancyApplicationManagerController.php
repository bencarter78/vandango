<?php

namespace App\Http\Controllers\Blink;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Blink\Repositories\Vacancies;
use App\Events\Blink\ApplicationManagerWasAssigned;

class VacancyApplicationManagerController extends Controller
{
    /**
     * @var
     */
    protected $vacancies;

    /**
     * VacancyApplicationManagerController constructor.
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $this->validate($request, ['user_id' => 'required']);
        $vacancy = $this->vacancies->requireById($id);
        $vacancy->update(['application_manager_id' => $request->user_id]);
        event(new ApplicationManagerWasAssigned($vacancy, Auth::user()));

        return back()->with('success', 'You have successfully update the application manager');
    }
}
