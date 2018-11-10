<?php

namespace TaskLoan\Http\Controllers\Api;

use Illuminate\Http\Request;
use TaskLoan\Http\Controllers\Controller;
use TaskLoan\Http\Requests\TaskStatusRequest;
use TaskLoan\Task;

class TaskStatusController extends Controller
{
    public function store(TaskStatusRequest $request, Task $task)
    {
        switch ($request->input('status')) {
            case 'completed':
                $task->completed_at = now();
                break;
            case 'verified':
                $task->verified_at = now();
                break;
        }

        $task->save();

        return $task;
    }
}
