<?php

namespace App\Console\Commands\Blink;

use Carbon\Carbon;
use App\Blink\Models\Status;
use App\Blink\Models\Contact;
use App\Blink\Models\Enquiry;
use Illuminate\Console\Command;
use App\UserManager\Users\User;
use Tck\HumanNameParser\Parser;
use App\Blink\Models\Organisation;
use App\Locations\Models\Location;
use Illuminate\Database\Eloquent\Model;

class ImportPortalEnquiries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blink:import-enquiries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports enquiries from the Portal';

    /**
     * @var
     */
    protected $unassignedStatusId = 6;

    /**
     * @var int
     */
    protected $superuser = 1;

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Model::unguard();
        $enquiries = \DB::connection('portal')
                        ->table('enquiries_details')
                        ->select('enquiries_details.*', 'data_users.email as adviserEmail', 'enquiries_completed_reasons.completed_reasons as completed_reason')
                        ->leftJoin('data_users', 'enquiries_details.linkAdviser', '=', 'data_users.id')
                        ->leftJoin('enquiries_completed_reasons', 'enquiries_completed_reasons.id', '=', 'enquiries_details.completed_reason')
                        ->where('type', 'Employer')
                        ->get();

        $enquiries->each(function ($e) {

            // Create the organisation
            $organisation = Organisation::updateOrCreate(['name' => $e->company], [
                'name' => $e->company,
                'tel' => $e->tel,
                'email' => $e->email,
            ]);

            // Create the contact
            $name = new Parser($e->contact);
            $contact = Contact::firstOrCreate([
                'organisation_id' => $organisation->id,
                'first_name' => $name->firstName(),
                'surname' => $name->surname(),
                'tel' => $e->tel,
                'email' => $e->email,
            ]);

            // Create the location
            $location = Location::firstOrCreate([
                'add1' => $e->add1,
                'add2' => $e->add2,
                'add3' => $e->town,
                'town' => $e->postTown,
                'county' => $e->county,
                'postcode' => $e->postCode,
                'owner_id' => $organisation->id,
                'owner_type' => Organisation::class,
            ]);

            // Create the enquiry
            $enquiry = Enquiry::create([
                'contact_id' => $contact->id,
                'created_at' => $e->entryDate,
                'location' => $location->present()->address(),
                'updated_at' => $e->entryDate,
            ]);

            // Create the status
            if ($status = Status::where('name', $e->lead_status)->first()) {
                $enquiry->statuses()->attach([$status->id], [
                    'updated_by' => $this->superuser,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            } elseif ($e->lead_status == 'Completed') {
                $status = Status::where('name', $e->completed_reason)->first();
                if ($status) {
                    $enquiry->statuses()->attach([$status->id], ['updated_by' => $this->superuser]);
                }
            } else {
                $enquiry->statuses()->attach([$this->unassignedStatusId], ['updated_by' => $this->superuser]);
            }

            // Create the owner
            $owner = User::withTrashed()->where('email', $e->adviserEmail)->first();
            if ($owner) {
                $enquiry->owners()->attach([$owner->id], [
                    'updated_by' => $this->superuser,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            // Create the activities
            $activities = \DB::connection('portal')
                             ->table('enquiries_events')
                             ->select('enquiries_events.*', 'data_users.id as owner_id')
                             ->join('data_users', 'enquiries_events.submitted_by', '=', 'data_users.id')
                             ->where('enquiry', $e->id)
                             ->get();

            $activities->each(function ($a) use ($enquiry) {
                $enquiry->activities()->create([
                    'note' => $a->notes,
                    'updated_by' => $enquiry->owners->count() > 0 ? $enquiry->owners->last()->id : 1,
                    'due_at' => Carbon::createFromFormat('Y-m-d', $a->when),
                    'created_at' => $a->entryDate,
                    'updated_at' => $a->entryDate,
                ]);
            });
        });
    }
}
