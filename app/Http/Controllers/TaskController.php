<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::get();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TasksRequest $request)
    {
        $data = $request->validated();
        $data['completed'] = false;

        $task = Task::create($data);
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function toggleCompleted(Request $request, Task $task)
    {
        $task->completed = !$task->completed;
        $task->save();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
