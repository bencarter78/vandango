<?php

namespace App\Http\Controllers\Blink;

use Illuminate\Http\Request;
use App\Blink\Models\Vacancy;
use App\Http\Controllers\Controller;

class VacancyRefController extends Controller
{
    /**
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $vacancy = Vacancy::findOrFail($id);
        $vacancy->update(['ref' => $request->ref]);

        return back()->with('success', 'You have successfully update the reference number');
    }
}
