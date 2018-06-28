<?php

namespace App\Console\Commands\Blink;

use Carbon\Carbon;
use App\Blink\Models\User;
use App\Blink\Models\Status;
use App\Blink\Models\Vacancy;
use App\Contracts\HttpClient;
use App\Blink\Models\Contact;
use App\Blink\Models\Enquiry;
use Illuminate\Console\Command;
use Tck\HumanNameParser\Parser;
use App\Blink\Models\Organisation;
use App\Locations\Models\Location;
use App\UserManager\Sectors\Sector;
use App\Events\Blink\VacancyWasReceived;

class FetchVacancies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blink:fetch-vacancies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches any new vacancies.';

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * Create a new command instance.
     *
     * @param HttpClient $client
     */
    public function __construct(HttpClient $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->client->get(config('vandango.blink.vacancies.import-uri'));

        collect($this->client->getContents())
            ->each(function ($s) {
                collect(json_decode($s->data))
                    ->each(function ($v) {
                        $vacancy = $this->add($v->data);
                        event(new VacancyWasReceived($vacancy));
                    });
            });
    }

    /**
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        $enquiry = Enquiry::findOrFail($data->enquiry->id);
        $this->saveOrganisation($data, $enquiry);
        $contact = $this->saveContact($data, $enquiry);
        $location = $this->saveLocations($data, $enquiry);
        $vacancy = $this->saveVacancy($data, $enquiry, $contact, $location);

        return $vacancy;
    }

    /**
     * @param $data
     * @param $enquiry
     */
    private function saveOrganisation($data, $enquiry)
    {
        $enquiry->contact->organisation->update((array)$data->organisation);
    }

    /**
     * @param $data
     * @param $enquiry
     * @return mixed
     */
    private function saveContact($data, $enquiry)
    {
        $name = new Parser($data->contact->name);

        return Contact::updateOrCreate([
            'organisation_id' => $enquiry->contact->organisation->id,
            'first_name' => $name->firstName(),
        ], [
            'organisation_id' => $enquiry->contact->organisation->id,
            'first_name' => $name->firstName(),
            'surname' => $name->surname(),
            'email' => $data->contact->email,
            'tel' => $data->contact->tel,
            'job_title' => $data->contact->job_title,
        ]);
    }

    /**
     * @param $data
     * @param $enquiry
     * @return mixed
     */
    private function saveLocations($data, $enquiry)
    {
        // Update/Add Head Office Location
        if ($data->location->hq_add1 !== '') {
            Location::updateOrCreate([
                'add1' => $data->location->hq_add1,
                'town' => $data->location->hq_add1,
                'postcode' => $data->location->hq_postcode,
                'owner_id' => $enquiry->contact->organisation->id,
                'owner_type' => Organisation::class,
            ], [
                'add1' => $data->location->hq_add1,
                'add2' => $data->location->hq_add2,
                'add3' => $data->location->hq_add3,
                'town' => $data->location->hq_town,
                'county' => $data->location->hq_county,
                'postcode' => $data->location->hq_postcode,
                'owner_id' => $enquiry->contact->organisation->id,
                'owner_type' => Organisation::class,
            ]);
        }

        return Location::updateOrCreate([
            'add1' => $data->location->vacancy_add1,
            'town' => $data->location->vacancy_add1,
            'postcode' => $data->location->vacancy_postcode,
            'owner_id' => $enquiry->contact->organisation->id,
            'owner_type' => Organisation::class,
        ], [
            'add1' => $data->location->vacancy_add1,
            'add2' => $data->location->vacancy_add2,
            'add3' => $data->location->vacancy_add3,
            'town' => $data->location->vacancy_town,
            'county' => $data->location->vacancy_county,
            'postcode' => $data->location->vacancy_postcode,
            'owner_id' => $enquiry->contact->organisation->id,
            'owner_type' => Organisation::class,
        ]);
    }

    /**
     * @param $data
     * @param $enquiry
     * @param $contact
     * @param $location
     * @return mixed
     */
    private function saveVacancy($data, $enquiry, $contact, $location)
    {
        $now = Carbon::now();
        $submittedBy = User::where('username', $data->submitted_by)->first();

        $vacancy = Vacancy::create([
            'enquiry_id' => $enquiry->id,
            'contact_id' => $contact->id,
            'location_id' => $location->id,
            'submitted_by' => $submittedBy->id,
            'title' => $data->employment->title,
            'framework' => $data->employment->framework,
            'qual_type' => $data->employment->qual_type,
            'level' => $data->employment->level,
            'duration' => $data->employment->duration,
            'wage' => $data->employment->wage,
            'sector_id' => Sector::where('code', $data->employment->sector)->first()->id,
            'hours' => $data->employment->hours,
            'working_week' => $data->employment->working_week,
            'closes_on' => Carbon::createFromFormat('d/m/Y', $data->dates->closes_on),
            'interviews_on' => Carbon::createFromFormat('d/m/Y', $data->dates->interviews_on),
            'starts_on' => Carbon::createFromFormat('d/m/Y', $data->dates->starts_on),
            'positions_count' => $data->employment->positions_count,
            'description' => $data->employment->description,
            'required_skills' => $data->requirements->required_skills,
            'required_qualifications' => $data->requirements->required_qualifications,
            'personal_qualities' => $data->requirements->personal_qualities,
            'training_provided' => $data->requirements->training_provided,
            'future_prospects' => $data->requirements->future_prospects,
            'considerations' => $data->requirements->considerations,
            'question_1' => $data->questions[0],
            'question_2' => $data->questions[1],
            'filter_applications' => $data->general->filter_applications,
            'is_visible' => $data->general->is_visible,
            'application_route_url' => $data->general->application_route_url,
            'organisation_description' => $data->organisation->description,
        ]);

        $vacancy->statuses()->attach(
            Status::find(config('vandango.blink.vacancies.pendingApprovalStatusId'))->id, [
            'updated_by' => $submittedBy->id,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return $vacancy;
    }
}
