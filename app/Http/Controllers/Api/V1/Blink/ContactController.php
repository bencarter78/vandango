<?php

namespace App\Http\Controllers\Api\V1\Blink;

use App\Blink\Models\Contact;
use Illuminate\Http\Request;
use App\Blink\Repositories\Contacts;
use App\Http\Controllers\Controller;
use Tck\HumanNameParser\Parser;

class ContactController extends Controller
{
    /**
     * @var
     */
    protected $contacts;

    /**
     * CustomerController constructor.
     *
     * @param $contacts
     */
    public function __construct(Contacts $contacts)
    {
        $this->contacts = $contacts;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $contacts = $request->has('q')
            ? $this->contacts->searchByName($request->get('q'))
            : $this->contacts->getAll('first_name');

        return response()->json([
            'ok' => true,
            'results' => $contacts->load('organisation', 'organisation.locations'),
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'email' => 'nullable|email']);

        $name = new Parser($request->name);

        return $this->response(Contact::create([
            'organisation_id' => $request->organisation_id,
            'first_name' => $name->firstName(),
            'surname' => $name->surname(),
            'tel' => $request->tel,
            'email' => $request->email,
            'job_title' => $request->job_title,
        ]));
    }
}
