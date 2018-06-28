<?php

namespace App\Http\Controllers\Classroom;

use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classroom\Models\LearningAgreement;

class LearningAgreementController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agreement = LearningAgreement::find($id);

        return view('classroom.agreements.edit', [
            'agreement' => $agreement,
            'cost' => number_format($agreement->timetable->users->where('id', $agreement->user_id)->first()->pivot->cost, 2, '.', ','),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int    $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if ( ! Hash::check($request->get('password'), Auth::user()->password)) {
            return back()->with('error', 'Your password did not match the one we have in the database. Please try again.');
        }

        $agreement = LearningAgreement::find($id);
        $agreement->update(['is_signed' => true]);
        $agreement->delete();

        return redirect()->to('classroom/me')
                         ->with('success', 'You have successfully confirmed your learning agreement.');
    }
}
