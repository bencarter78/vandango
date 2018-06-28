<?php
namespace App\Console\Commands\Judi;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Judi\Models\Assessment;
use App\Mail\Judi\AssessmentMailer;
use App\Judi\Models\SectorSchedule;

class AssessmentNotifier extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'judi:notify';

    /**
     * @var int
     */
    protected $advanceWarning = 5;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifies of pending Performance Assessments';
    /**
     * @var AssessmentMailer
     */
    private $mailer;

    /**
     * Create a new command instance.
     *
     * @param AssessmentMailer $mailer
     */
    public function __construct(AssessmentMailer $mailer)
    {
        parent::__construct();
        $this->mailer = $mailer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $period = Carbon::now()->startOfMonth()->addMonths($this->advanceWarning);
        $assessments = SectorSchedule::where('month', $period->format('n'))->get();
        foreach ($assessments as $assessment) {
            $count = Assessment::where('sector_id', $assessment->sector->id)
                               ->where('assessment_date', '>=', $period->format('Y-m-d'))
                               ->where('assessment_date', '<=', $period->endOfMonth()->format('Y-m-d'))
                               ->count();
            if ($count > 0) {
                $this->info($assessment->sector->department->manager->email . ' ' . $assessment->sector->name);
                $this->mailer->notifySectorManager($assessment->sector->department->manager, $assessment->sector);
            }
        }
    }
}
