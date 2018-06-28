<?php
namespace App\Console\Commands\SurveyHound;

use Illuminate\Console\Command;
use App\Jobs\SurveyHound\SendSurvey;
use App\SurveyHound\SurveyRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Surveyor extends Command
{
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'surveyor:send {--frequency=} {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends out surveys to relevant recipients.';

    /**
     * @var DbRepository
     */
    private $repository;

    /**
     * @var array
     */
    protected $surveys = [];

    /**
     * Create a new command instance.
     *
     * @param SurveyRepository $repository
     */
    public function __construct(SurveyRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->surveys() as $survey) {
            $this->dispatch(
                new SendSurvey($survey)
            );
        }
    }

    /**
     * @return mixed
     */
    public function surveys()
    {
        if ($this->option('id')) {
            return [$this->repository->requireById($this->option('id'))];
        }

        if ($this->option('frequency')) {
            return $this->repository->getByFrequency($this->option('frequency'));
        }
    }
}
