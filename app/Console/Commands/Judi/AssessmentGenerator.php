<?php

namespace App\Console\Commands\Judi;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Judi\Models\Assessment;
use App\Jobs\Judi\PlanAssessments;
use App\Judi\Repositories\UserRepository;
use App\Judi\Repositories\SectorRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Judi\Repositories\AssessmentRepository;
use App\Events\Judi\SectorAssessmentsWerePlanned;

class AssessmentGenerator extends Command
{
    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'judi:generate {--month=6}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the assessments for Performance Assessment.';

    /**
     * @var AssessmentPlannerHandler
     */
    protected $sectors;

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var array
     */
    protected $assessments = [];

    /**
     * Create a new command instance.
     *
     * @param AssessmentRepository|SectorRepository $sectors
     * @param UserRepository                        $users
     */
    public function __construct(SectorRepository $sectors, UserRepository $users)
    {
        parent::__construct();
        $this->sectors = $sectors;
        $this->users = $users;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $sectors = $this->sectors->getSectorsDueForPaInMonth($this->getMonth());

        $sectors->each(function ($sector) {
            $this->planAssessments($sector);
        });

        event(new SectorAssessmentsWerePlanned($sectors));
    }

    /**
     * @param $sector
     */
    public function planAssessments($sector)
    {
        $this->users->getAssessableSectorStaff($sector)->each(function ($user) use ($sector) {
            $this->dispatch(new PlanAssessments($user, $sector));
        });
    }

    /**
     * @return string
     */
    public function getMonth()
    {
        return Carbon::now()->addMonths($this->option('month'))->format('m');
    }
}
