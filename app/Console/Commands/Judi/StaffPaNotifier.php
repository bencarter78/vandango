<?php
namespace App\Console\Commands\Judi;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Mail\Judi\AssessmentMailer;
use App\Judi\Repositories\SectorRepository;
use App\Judi\Repositories\AssessmentRepository;

class StaffPaNotifier extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'judi:notify-staff';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifies staff of upcoming PA activity for secotr.';

    /**
     * @var int
     */
    protected $monthsInAdvance = 2;

    /**
     * @var SectorRepository
     */
    private $repository;

    /**
     * @var AssessmentMailer
     */
    private $mailer;

    /**
     * Create a new command instance.
     *
     * @param AssessmentRepository $repository
     * @param AssessmentMailer     $mailer
     */
    public function __construct(AssessmentRepository $repository, AssessmentMailer $mailer)
    {
        parent::__construct();
        $this->repository = $repository;
        $this->mailer = $mailer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->getAssessments()->groupBy('user_id') as $assessment) {
            $this->info($assessment[0]->user->present()->name);
            $this->mailer->sendUserAssessmentNotification($assessment[0]->user);
        }
    }

    public function users()
    {
        return $this->getAssessments()->groupBy('user_id');
    }

    /**
     * @return mixed
     */
    public function getAssessments()
    {
        return $this->repository->getActivityInMonth(
            Carbon::now()->startOfMonth()->addMonths($this->monthsInAdvance)->format('Y-m')
        );
    }

}
