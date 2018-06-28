<?php

namespace App\Http\Controllers\Blink;

use App\Blink\Models\Sector;
use App\Http\Controllers\Controller;
use App\Blink\Models\ApplicationManager;

class VacancyReportController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('blink.reports.vacancies', [
            'sectors' => Sector::with('vacancies')->whereHas('vacancies', function ($q) {
                $q->withTrashed();
            })->get(),
            'applicationManagers' => ApplicationManager::with('vacancies')->whereHas('vacancies', function ($q) {
                $q->withTrashed();
            })->orderBy('first_name')->orderBy('surname')->get(),
        ]);
    }
}
