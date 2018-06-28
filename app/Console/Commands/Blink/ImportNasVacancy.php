<?php

namespace App\Console\Commands\Blink;

use Carbon\Carbon;
use App\Services\NasClient;
use App\Blink\Models\Status;
use App\Blink\Models\Vacancy;
use App\Models\Nas\Framework;
use Illuminate\Console\Command;
use App\Blink\Models\Organisation;
use App\Models\Level;

class ImportNasVacancy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blink:import-vacancy {ref}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Return vacancy summary for a given reference number';

    /**
     * @var string
     */
    protected $wsdl = 'https://soapapi.findapprenticeship.service.gov.uk/Services/VacancyDetails/VacancyDetails51.svc?WSDL';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \App\Exceptions\NasSoapException
     */
    public function handle()
    {
        $response = (new NasClient($this->wsdl))->requestFromMethod('Get', [
            'VacancySearchCriteria' => [
                'VacancyReferenceId' => $this->argument('ref'),
                'VacancyLocationType' => 'NonNational',
                'PageIndex' => 1,
            ],
        ]);

        if ($response->SearchResults->TotalPages > 0) {
            $data = $response->SearchResults->SearchResults->VacancyFullData;
            $organisation = Organisation::where('name', $data->EmployerName)
                                        ->orWhere('alias', 'LIKE', "%$data->EmployerName%")
                                        ->first();

            if ($organisation) {
                $location = $this->saveLocation($organisation, $data);
                $vacancy = $this->saveVacancy($data, $organisation, $location);
                $this->info('Successfully imported vacancy with ref ' . $data->VacancyReference);
                $this->markAsLive($vacancy);
            } else {
                $this->error('Could not find an enquiry for ' . $data->EmployerName);
            }
        } else {
            $this->error('Vacancy ' . $this->argument('ref') . ' could not be found.');
        }
    }

    /**
     * @param $organisation
     * @param $data
     * @return mixed
     */
    private function saveLocation($organisation, $data)
    {
        return $organisation->locations()->updateOrCreate([
            'add1' => $data->VacancyAddress->AddressLine1,
            'postcode' => $data->VacancyAddress->PostCode,
        ], [
            'add1' => $data->VacancyAddress->AddressLine1,
            'add2' => $data->VacancyAddress->AddressLine2,
            'add3' => $data->VacancyAddress->AddressLine3,
            'town' => $data->VacancyAddress->Town,
            'county' => $data->VacancyAddress->County,
            'postcode' => $data->VacancyAddress->PostCode,
            'latitude' => $data->VacancyAddress->Latitude,
            'longitude' => $data->VacancyAddress->Longitude,
        ]);
    }

    /**
     * @param $data
     * @param $organisation
     * @param $location
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function saveVacancy($data, $organisation, $location)
    {
        $framework = Framework::where('full_name', 'LIKE', "%$data->ApprenticeshipFramework%")->first();

        $vacancy = Vacancy::updateOrCreate(['ref' => $data->VacancyReference], [
            'enquiry_id' => $organisation->enquiries->last()->id,
            'contact_id' => $organisation->enquiries->last()->contact_id,
            'location_id' => $location->id,
            'application_manager_id' => null,
            'submitted_by' => $organisation->enquiries->last()->activities->first()->updated_by,
            'title' => $data->VacancyTitle,
            'framework_id' => $framework->id,
            'qual_type' => str_contains($data->VacancyType, 'Apprenticeship') ? 0 : 1,
            'level_id' => $this->getLevel($data->VacancyType),
            'duration' => $this->getDuration($data->ExpectedDuration),
            'wage' => $this->getWage($data->WageText),
            'sector_id' => $framework->sector_id,
            'working_week' => $data->WorkingWeek,
            'closes_on' => Carbon::createFromFormat('Y-m-d\TH:i:s', $data->ClosingDate),
            'interviews_on' => Carbon::createFromFormat('Y-m-d\TH:i:s', $data->InterviewFromDate),
            'starts_on' => Carbon::createFromFormat('Y-m-d\TH:i:s', $data->PossibleStartDate),
            'positions_count' => $data->NumberOfPositions,
            'description' => $data->FullDescription,
            'required_skills' => $data->SkillsRequired,
            'required_qualifications' => $data->QualificationRequired,
            'personal_qualities' => $data->PersonalQualities,
            'training_provided' => $data->TrainingToBeProvided,
            'future_prospects' => $data->FutureProspects,
            'filter_applications' => true,
            'considerations' => $data->OtherImportantInformation,
            'question_1' => $data->SupplementaryQuestion1,
            'question_2' => $data->SupplementaryQuestion2,
            'is_visible' => true,
            'application_route_url' => null,
            'organisation_description' => $data->EmployerDescription,
        ]);

        // Update Ref
        $vacancy->update(['ref' => $data->VacancyReference]);

        return $vacancy;
    }

    /**
     * @param $type
     * @return false|int|string
     */
    private function getLevel($type)
    {
        switch ($type) {
            case str_contains($type, 'Advanced'):
                return Level::whereName('Level 3')->first()->id;
            case str_contains($type, 'Higher'):
                return Level::whereName('Level 4')->first()->id;
            default:
                return Level::whereName('Level 2')->first()->id;
        }
    }

    /**
     * @param $duration
     * @return float|int|mixed
     */
    private function getDuration($duration)
    {
        if (str_contains($duration, 'years')) {
            return trim(str_replace('years', '', $duration)) * 12;
        }

        return trim(str_replace('months', '', $duration));
    }

    /**
     * @param $wage
     * @return int|null|string|string[]
     */
    private function getWage($wage)
    {
        if (str_contains($wage, '-')) {
            $wage = trim(collect(explode('-', $wage))->last());
        }

        $amount = preg_replace('/[^0-9\.]/', '', $wage);

        if ($amount == '') {
            return 0;
        }

        return $amount;
    }

    /**
     * @param $vacancy
     */
    private function markAsLive($vacancy)
    {
        $vacancy->statuses()->attach(Status::whereName(config('vandango.blink.statuses.vacancy-live'))->first()->id);
    }
}
