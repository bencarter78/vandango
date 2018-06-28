<?php

namespace App\Http\Controllers\Blink;

use App\Http\Controllers\Controller;
use App\Blink\Repositories\Organisations;
use App\Http\Requests\Blink\OrganisationRequest;

class OrganisationController extends Controller
{
    /**
     * @var Organisations
     */
    private $organisations;

    /**
     * OrganisationController constructor.
     *
     * @param Organisations $organisations
     */
    public function __construct(Organisations $organisations)
    {
        $this->organisations = $organisations;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blink.organisations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organisation = $this->organisations->requireById($id)->load('allEnquiries', 'contacts', 'locations');

        return view('blink.organisations.show', [
            'organisation' => $organisation,
            'live' => $organisation->enquiries->filter(function ($enquiry) {
                return $enquiry->deleted_at == null;
            }),
            'completed' => $organisation->enquiries->filter(function ($enquiry) {
                return $enquiry->deleted_at != null;
            }),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrganisationRequest $request
     * @param  int                $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrganisationRequest $request, $id)
    {
        $this->organisations->requireById($id)->update($request->all());

        return back()->with('success', 'You have successfully updated the organisation.');
    }
}
