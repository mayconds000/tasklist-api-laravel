<?php

namespace App\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function get(Request $request)
    {
        return Task::withTrashed()->all();
    }

    public function store(Request $request)
    {
        $task = Task::create($request->only(['title', 'status']));
        return response()->json($task, 201);
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->only(['title', 'status']));
        return response()->json($task, 200);
    }

    public function delete(Task $task)
    {
        $task->delete();
        return response()->json('', 204);
    }
}
