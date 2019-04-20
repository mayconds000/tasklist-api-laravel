<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function get(Request $request)
    {
        $tasks = Task::all();
        return response()->json($tasks->toArray());
    }

    public function store(Request $request)
    {
        $task = Task::create($request->only(['title', 'status']))->fresh();
        return response()->json($task->toArray(), 201);
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->only(['title', 'status']));
        return response()->json($task->fresh()->toArray(), 200);
    }

    public function delete(Task $task)
    {
        $task->delete();
        return response()->json($task->toArray(), 204);
    }
}
