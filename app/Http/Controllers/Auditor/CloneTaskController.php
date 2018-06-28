<?php

namespace App\Http\Controllers\Auditor;

use App\Auditor\Tasks\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CloneTaskController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $task = Task::findOrFail($request->task_id);
        $newTask = $task->replicate();
        $newTask->title = $task->title . ' Copy';
        $newTask->run_frequency = '';
        $newTask->push();

        return back()->with('success', 'You have successfully cloned the task');
    }
}
