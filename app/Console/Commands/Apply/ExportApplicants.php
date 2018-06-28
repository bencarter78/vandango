<?php

namespace App\Console\Commands\Apply;

use Carbon\Carbon;
use App\Pics\Organisation;
use App\Contracts\Datastore;
use App\Apply\Models\Applicant;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\Apply\ExportedApplicantsReport;

class ExportApplicants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apply:export {programme}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export apply data to CSV';

    /**
     * @var Datastore
     */
    private $pics;

    /**
     * @var
     */
    private $data;

    /**
     * Create a new command instance.
     *
     * @param Organisation $pics
     */
    public function __construct(Organisation $pics)
    {
        parent::__construct();
        $this->pics = $pics;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Applicant::whereProgrammeType($this->argument('programme'))->get()->each(function ($applicant) {
            $data = $applicant->toArray();
            $data['sector_id'] = $applicant->sector->code;
            if ($applicant->pics_organisation_id) {
                $org = $this->pics->find($applicant->pics_organisation_id);
                $data['postcode'] = $org->PostCode;
            }
            $this->data[] = $data;
        });

        $filename = 'vandango-apply-' . $this->argument('programme') . '_' . Carbon::now()->format('YmdHis');

        Excel::create($filename, function ($excel) {
            $excel->sheet('applicants', function ($sheet) {
                $sheet->with($this->data);
            });
        })->store('xlsx');

        Mail::to(config('vandango.emails.das'))->send(new ExportedApplicantsReport($this->argument('programme'), 'exports/' . $filename . '.xlsx'));

        Storage::disk('exports')->delete($filename . '.xlsx');
    }
}
