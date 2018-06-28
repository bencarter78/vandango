<?php

namespace App\Http\Controllers\Blink;

use Illuminate\Http\Request;
use App\Jobs\Blink\SaveContact;
use App\Jobs\Blink\SaveOrganisation;
use App\Blink\Repositories\Contacts;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * @var
     */
    protected $contacts;

    /**
     * ContactController constructor.
     *
     * @param $contacts
     */
    public function __construct(Contacts $contacts)
    {
        $this->contacts = $contacts;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('blink.contacts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('blink.contacts.show', [
            'contact' => $this->contacts->requireById($id)->load('organisation', 'allEnquiries'),
        ]);
    }

    /**
     * @param         $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $request->merge([
            'contact_id' => $id,
            'organisation_name' => $request->get('search')['organisation_id'],
        ]);

        $organisation = dispatch(new SaveOrganisation($request->all()));

        $request->merge(['organisation' => $organisation]);

        dispatch(new SaveContact($request->all()));

        return back()->with('success', 'You have successfully updated the contact');
    }
}
