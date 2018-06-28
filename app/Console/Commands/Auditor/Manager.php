<?php

namespace App\Console\Commands\Auditor;

use Illuminate\Console\Command;
use App\Jobs\Auditor\ConductAudit;
use App\Auditor\Tasks\TaskRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Manager extends Command
{
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'audit:run {--frequency=} {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs Auditor.';

    /**
     * @var TaskRepository
     */
    protected $repository;

    /**
     * Create a new command instance.
     *
     * @param TaskRepository $repository
     */
    public function __construct(TaskRepository $repository)
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
        foreach ($this->tasks() as $task) {
            $this->dispatch(new ConductAudit($task));
        }
    }

    /**
     * @return mixed
     */
    public function tasks()
    {
        if ($this->option('id')) {
            return [$this->repository->requireById($this->option('id'))];
        }

        if ($this->option('frequency')) {
            return $this->repository->getByFrequency($this->option('frequency'));
        }
    }

}
