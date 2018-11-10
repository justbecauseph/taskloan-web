<?php

namespace TaskLoan\Http\Controllers\Api;

use Illuminate\Http\Request;
use TaskLoan\Http\Controllers\Controller;
use TaskLoan\Http\Requests\UserTaskRequest;
use TaskLoan\Task;
use TaskLoan\LoanApplication;

class UserTaskController extends Controller
{
    public function store(UserTaskRequest $request)
    {
        /** @var Task $task */
        $task = Task::find($request->input('id'));

        $task->claimedByUser()->associate($request->user());

        $task->save();

        $loanApplication = new LoanApplication();
        $loanApplication->amount = $task->amount;
        $loanApplication->reason = $request->input('reason');
        $loanApplication->task()->associate($task);
        $loanApplication->user()->associate($request->user());
        $loanApplication->save();

        return $task;
    }
}
