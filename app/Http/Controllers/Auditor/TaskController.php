<?php

namespace App\Http\Controllers\Auditor;

use App\Auditor\Tasks\Task;
use App\Models\EmailTemplate;
use App\Auditor\Categories\Category;
use App\Http\Controllers\Controller;
use App\Auditor\Tasks\TaskRepository;
use App\Http\Requests\Auditor\StoreTaskRequest;

class TaskController extends Controller
{
    /**
     * @var TaskInterface
     */
    protected $tasks;

    /**
     * @param TaskRepository $tasks
     */
    function __construct(TaskRepository $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('auditor.tasks.index', [
            'tasks' => Task::orderBy('title')->with('category')->get(),
        ]);

        return view('auditor.tasks.categories', [
            'categories' => Category::orderBy('name')->has('tasks')->with('tasks')->get(),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return view('auditor.tasks.show', ['task' => $this->tasks->requireById($id)]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auditor.tasks.create', [
            'categories' => Category::orderBy('name')->get(),
            'templates' => EmailTemplate::orderBy('name')->get(),
        ]);
    }

    /**
     * @param StoreTaskRequest $request
     * @return mixed
     */
    public function store(StoreTaskRequest $request)
    {
        $this->tasks->create($request->all());

        return redirect()->route('auditor.tasks.index')->with('success', 'You have successfully created a new task.');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $task = $this->tasks->requireById($id);

        return view('auditor.tasks.edit', [
            'task' => $task,
            'categories' => Category::orderBy('name')->get(),
            'templates' => EmailTemplate::orderBy('name')->get(),
        ]);
    }

    /**
     * @param StoreTaskRequest $request
     * @param                  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreTaskRequest $request, $id)
    {
        $this->tasks->update($id, $request->all());

        return back()->with('success', 'You have successfully updated the task.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->tasks->requireById($id)->delete();

        return back()->with('success', 'Task has been deleted.');
    }

    /**
     * Returns a listing of trashed departments
     */
    public function getTrashed()
    {
        return view('general.trashed', [
            'collection' => $this->tasks->getAllTrashedPaginated(20, 'title'),
            'title' => 'Task',
            'route' => 'auditor.tasks.restore',
        ]);
    }

    /**
     * Restores a from trash
     *
     * @param $id
     * @return mixed
     */
    public function restore($id)
    {
        if ( ! $this->tasks->restoreById($id)) {
            return redirect()->back()->with('error', 'Sorry, there was an error with this request. Please try again later.');
        }

        return redirect()->route('auditor.tasks.index')->with('success', 'You have successfully restored the item.');
    }

}