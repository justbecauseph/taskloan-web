<?php

namespace TaskLoan\Http\Controllers\Api;

use Illuminate\Http\Request;
use TaskLoan\Http\Controllers\Controller;
use TaskLoan\Http\Requests\TaskRequest;
use TaskLoan\Task;
use TaskLoan\User;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        return Task::filter($request->all())->get();
    }

    public function store(TaskRequest $request)
    {
        $task = new Task($request->all());

        $task->user()->associate($request->user());

        $task->save();

        /** @var User $user */
        $user = $request->user();
        $user->decrementWallet($task->amount);

        return $task;
    }
}
