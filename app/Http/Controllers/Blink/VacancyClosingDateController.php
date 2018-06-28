<?php

namespace App\Http\Controllers\Blink;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Blink\Models\Vacancy;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VacancyClosingDateController extends Controller
{
    /**
     * @param         $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $this->validate($request, ['closes_on' => 'required|date_format:d/m/Y']);
        $vacancy = Vacancy::findOrFail($id);
        $vacancy->updateClosingDate(Carbon::createFromFormat('d/m/Y', $request->closes_on));
        $vacancy->enquiry->activities()->create([
            'due_at' => Carbon::now(),
            'note' => "The closing date for the $vacancy->title[Ref: $vacancy->ref] vacancy has been changed to $request->closes_on",
            'updated_by' => Auth::user()->id,
        ]);

        return back()->with('success', 'You have successfully updated the closing date');
    }
}
