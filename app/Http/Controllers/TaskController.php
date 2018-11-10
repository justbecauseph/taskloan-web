<?php

namespace TaskLoan\Http\Controllers;

use Illuminate\Http\Request;
use TaskLoan\Http\Requests\TaskRequest;
use TaskLoan\Task;

class TaskController extends Controller
{
    public function create()
    {
        return view('task.create');
    }

    public function store(TaskRequest $request)
    {
        $task = new Task($request->all());
        $task->user()->associate($request->user());
        $task->save();

        return redirect()
            ->route('home')
            ->with('status', 'Task created.');
    }
}
