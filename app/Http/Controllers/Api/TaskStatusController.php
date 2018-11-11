<?php

namespace TaskLoan\Http\Controllers\Api;

use Illuminate\Http\Request;
use TaskLoan\Http\Controllers\Controller;
use TaskLoan\Http\Requests\TaskStatusRequest;
use TaskLoan\Task;
use TaskLoan\User;

class TaskStatusController extends Controller
{
    public function store(TaskStatusRequest $request, Task $task)
    {
        /** @var User $user */
        $user = $request->user();
        $task = $task->exists ? $task : $user->claimedTask;

        switch ($request->input('status')) {
            case 'completed':
                $task->completed_at = now();
                break;
            case 'verified':
                $task->verified_at = now();
                $task->claimedByUser->clearLoan();
                break;
        }

        $task->save();

        return $task;
    }
}
