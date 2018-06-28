<?php

namespace App\Http\Controllers\Auditor;

use Illuminate\Http\Request;
use App\Jobs\Auditor\ConductAudit;
use App\Http\Controllers\Controller;
use App\Auditor\Tasks\TaskRepository;
use App\Events\Auditor\AuditWasRequested;

class AuditController extends Controller
{
    /**
     * @var TaskRepository
     */
    private $tasks;

    /**
     * TaskSendController constructor.
     *
     * @param $tasks
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @param         $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index($id)
    {
        $task = $this->tasks->requireById($id);

        $this->dispatch(new ConductAudit($task));

        return response([
            'status' => 'ok',
        ], 200);
    }
}
