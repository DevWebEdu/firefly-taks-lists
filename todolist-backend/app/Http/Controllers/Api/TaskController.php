<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->get();

        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $task = auth()->user()->tasks()->create($request->validated());

        return response()->json([
            'message' => 'Task created successfully',
            'task' => $task,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    
    public function show($id)
    {
        $task = Task::find($id);

        if (!$task || $task->user_id !== auth()->id()) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $task->update($request->validated());

        return response()->json([
            'message' => 'Task updated successfully',
            'task' => $task,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);

        if (!$task || $task->user_id !== auth()->id()) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }

    public function toggleStatus($id)
    {
        $task = Task::find($id);

        if (!$task || $task->user_id !== auth()->id()) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->status = $task->status === 'completed' ? 'pending' : 'completed';
        $task->save();

        return response()->json([
            'message' => 'Task marked as completed',
            'task' => $task,
        ]);
    }
}
