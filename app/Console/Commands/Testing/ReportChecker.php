<?php

namespace App\Console\Commands\Testing;

use App\Auditor\Tasks\Task;
use Illuminate\Console\Command;
use App\Jobs\Auditor\ConductAudit;
use Illuminate\Foundation\Bus\DispatchesJobs;

class ReportChecker extends Command
{
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test-auditor:check-reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks to see if the reports are working';

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
     */
    public function handle()
    {
        $tasks = Task::all();
        foreach ($tasks as $task) {
            $this->line("Running [$task->id] $task->title");
            $this->dispatch(new ConductAudit($task));
            $this->info('Completed task check.');
        }
    }

}
