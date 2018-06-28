<?php

namespace App\Jobs\Auditor;

use App\Jobs\Job;
use App\Auditor\Tasks\Task;
use App\Contracts\Datastore;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Events\Auditor\TaskRunnerHasFinished;
use App\Events\Auditor\TaskRunnerStageWasReached;

class ConductAudit extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, DispatchesJobs;

    /**
     * @var Task
     */
    private $task;

    /**
     * @var
     */
    private $auditResults;

    /**
     * Create a new job instance.
     *
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     *
     * @param Datastore $datastore
     */
    public function handle(Datastore $datastore)
    {
        if (! app()->runningInConsole()) {
            event(new TaskRunnerStageWasReached($this->task, [
                'msg' => "Querying PICS...",
            ]));
        }

        $this->audit($datastore);

        foreach ($this->auditResults as $result) {
            $this->dispatch(
                new SendAuditResultNotification($this->task, $result)
            );
        }

        if (! app()->runningInConsole()) {
            event(new TaskRunnerHasFinished($this->task));
        }
    }

    /**
     * @param Datastore $datastore
     *
     * @return mixed
     */
    public function audit(Datastore $datastore)
    {
        $this->auditResults = collect($datastore->query($this->task->sql));

        if (! app()->runningInConsole()) {
            event(new TaskRunnerStageWasReached($this->task, [
                'msg' => 'PICS has been queried, ' . $this->auditResults->count() . ' results found.',
            ]));
        }

        if ($this->isGrouped()) {
            if (! app()->runningInConsole()) {
                event(new TaskRunnerStageWasReached($this->task, [
                    'msg' => 'Grouping results by ' . $this->task->group_by . '.',
                ]));
            }
            $this->auditResults = $this->auditResults->groupBy($this->task->group_by);
        }
    }

    /**
     * @return mixed
     */
    public function isGrouped()
    {
        return $this->task->group_by;
    }
}
