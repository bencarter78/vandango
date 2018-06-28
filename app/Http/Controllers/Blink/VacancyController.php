<?php

namespace App\Http\Controllers\Blink;

use App\Models\Level;
use App\Blink\Models\User;
use Illuminate\Http\Request;
use App\Models\Nas\Framework;
use App\Jobs\Blink\SaveVacancy;
use App\UserManager\Sectors\Sector;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Blink\Repositories\Enquiries;
use App\Blink\Repositories\Vacancies;
use App\Http\Requests\Blink\VacancyRequest;

class VacancyController extends Controller
{
    /**
     * @var Vacancies
     */
    protected $vacancies;

    /**
     * @var Enquiries
     */
    private $enquiries;

    /**
     * VacancyController constructor.
     *
     * @param Vacancies $vacancies
     * @param Enquiries $enquiries
     */
    public function __construct(Vacancies $vacancies, Enquiries $enquiries)
    {
        $this->vacancies = $vacancies;
        $this->enquiries = $enquiries;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blink.vacancies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $enquiry = $this->enquiries->requireById($request->id, true);

        return view('blink.vacancies.create', [
            'enquiry' => $enquiry,
            'contacts' => $enquiry->contact->organisation->contacts->filter(function ($c) {
                return $c->email && $c->tel;
            }),
            'frameworks' => Framework::orderBy('full_name')->get(),
            'sectors' => Sector::orderBy('name')->get(),
            'levels' => Level::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VacancyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VacancyRequest $request)
    {
        return $this->save($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('blink.vacancies.show', [
            'vacancy' => $this->vacancies->requireById($id, true),
            'user' => User::find(Auth::user()->id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vacancy = $this->vacancies->requireById($id);

        return view('blink.vacancies.edit', [
            'vacancy' => $vacancy,
            'enquiry' => $vacancy->enquiry,
            'contacts' => $vacancy->contact->organisation->contacts->filter(function ($c) {
                return $c->email && $c->tel;
            }),
            'frameworks' => Framework::orderBy('full_name')->get(),
            'sectors' => Sector::orderBy('name')->get(),
            'levels' => Level::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VacancyRequest $request
     * @param  int           $id
     * @return \Illuminate\Http\Response
     */
    public function update(VacancyRequest $request, $id)
    {
        return $this->save($request, $this->vacancies->requireById($id));
    }

    /**
     * @param VacancyRequest $request
     * @param null           $model
     * @return \Illuminate\Http\RedirectResponse
     */
    private function save(VacancyRequest $request, $model = null)
    {
        $request->merge([
            'submitted_by' => Auth::user()->id,
            'enquiry_id' => $request->get('enquiry_id'),
            'application_manager_id' => $request->get('user_id'),
        ]);

        $this->dispatch(new SaveVacancy($request->all(), $model));

        $type = $request->has('save') ? 'saved' : 'submitted';

        return redirect()
            ->route('blink.enquiries.edit', $request->get('enquiry_id'))
            ->with('success', "You have successfully $type the vacancy");
    }
}
