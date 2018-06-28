<?php

namespace App\Http\Controllers\Blink;

use JavaScript;
use App\Blink\Models\Status;
use App\Blink\Models\Enquiry;
use App\Blink\Models\Referrer;
use App\Blink\Models\Conclusion;
use App\Blink\Repositories\Statuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Blink\Repositories\Enquiries;
use App\Jobs\Blink\SaveEnquiryDetails;
use App\Http\Requests\Blink\EnquiryRequest;
use App\UserManager\Sectors\SectorRepository;

class EnquiryController extends Controller
{
    /**
     * @var SectorRepository
     */
    protected $sectors;

    /**
     * @var Enquiries
     */
    private $enquiries;

    /**
     * @var Statuses
     */
    private $statuses;

    /**
     * EnquiryController constructor.
     *
     * @param Enquiries        $enquiries
     * @param SectorRepository $sectors
     * @param Statuses         $statuses
     */
    public function __construct(Enquiries $enquiries, SectorRepository $sectors, Statuses $statuses)
    {
        $this->sectors = $sectors;
        $this->enquiries = $enquiries;
        $this->statuses = $statuses;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blink.enquiries.index', [
            'enquiries' => $this->enquiries->getAllPaginated(20, 'updated_at', 'desc'),
            'sectors' => $this->sectors->getAll(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blink.enquiries.create', [
            'referrers' => Referrer::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EnquiryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EnquiryRequest $request)
    {
        if ($request->get('search')['organisation_id'] == '') {
            return back()->with('error', 'Please enter an organisation')->withInput();
        }

        $request->merge([
            'contact_name' => $request->get('search')['contact_id'],
            'organisation_name' => $request->get('search')['organisation_id'],
            'location' => $request->get('organisation_location'),
            'updated_by' => Auth::user()->id,
            'status_id' => Status::whereName(config('vandango.blink.enquiries.pending'))->first()->id,
        ]);

        $enquiry = $this->dispatch(new SaveEnquiryDetails($request->all()));

        return redirect()
            ->route('blink.enquiries.edit', [$enquiry->id])
            ->with('success', 'You have successfully submitted the enquiry');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        JavaScript::put('authUser', Auth::user());

        return view('blink.enquiries.edit', [
            'enquiry' => Enquiry::withTrashed()->with(
                'activities.owner', 'activities.updatedBy',
                'applicants.adviser', 'applicants.eportfolio', 'applicants.sector', 'applicants.submittedBy',
                'opportunities.sector', 'opportunities.submittedBy',
                'owners',
                'vacancies.statuses', 'vacancies.sector'
            )->findOrFail($id),
            'statuses' => $this->statuses->getTypeByOwner('live', Enquiry::class),
            'conclusions' => Conclusion::orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EnquiryRequest $request
     * @param  int           $id
     * @return \Illuminate\Http\Response
     */
    public function update(EnquiryRequest $request, $id)
    {
        $this->dispatch(new SaveEnquiryDetails($request->all(), $id));

        return back()->with('success', 'You have successfully updated the enquiry');
    }
}
