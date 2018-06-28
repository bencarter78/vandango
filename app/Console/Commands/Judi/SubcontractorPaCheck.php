<?php

namespace App\Console\Commands\Judi;

use Mail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Mail\Judi\SubcontractorDueForPa;
use App\Judi\Repositories\SectorRepository;
use App\UserManager\Departments\Department;

class SubcontractorPaCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'judi:check-subcontractor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks subcontractor due for Performance Assessment';

    /**
     * Number of months in advance to check for
     *
     * @var int
     */
    private $months = 3;

    /**
     * @var SectorRepository
     */
    private $sectors;

    /**
     * @var string
     */
    private $email = 'contractcompliance@totalpeople.co.uk';

    /**
     * Create a new command instance.
     *
     * @param SectorRepository $sectors
     */
    public function __construct(SectorRepository $sectors)
    {
        parent::__construct();
        $this->sectors = $sectors;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $subcontractors = $this->getSubcontractors();

        if ($subcontractors->count() > 0) {
            Mail::to($this->email)->queue(new SubcontractorDueForPa($subcontractors));
        }
    }

    /**
     * @return mixed
     */
    public function subcontractorDept()
    {
        return Department::whereDepartment('Sub-contractor')->first();
    }

    /**
     * @return mixed
     */
    public function getMonth()
    {
        return Carbon::now()->addMonths($this->months)->format('n');
    }

    public function getSubcontractors()
    {
        $sectors = $this->sectors->getSectorsDueForPaInMonth($this->getMonth());

        return $sectors->filter(function ($sector) {
            return $sector->department->id == $this->subcontractorDept()->id;
        });
    }
}
