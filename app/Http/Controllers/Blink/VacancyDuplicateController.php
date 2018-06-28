<?php

namespace App\Http\Controllers\Blink;

use App\Blink\Models\Vacancy;
use App\Jobs\Blink\SaveVacancy;
use App\Http\Controllers\Controller;

class VacancyDuplicateController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index($id)
    {
        $vacancy = $this->dispatch(new SaveVacancy(Vacancy::withTrashed()->findOrFail($id)->toArray()));

        return redirect()->route('blink.vacancies.edit', $vacancy->id);
    }
}
