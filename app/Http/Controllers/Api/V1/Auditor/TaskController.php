<?php

namespace App\Http\Controllers\Api\V1\Auditor;

use App\Auditor\Tasks\Task;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        return $this->response(Task::findOrFail($id)->delete());
    }
}
