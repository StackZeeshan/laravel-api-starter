<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\TaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class TaskController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // List all tasks for authenticated user
    public function index(Request $request): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user(); // or Auth::user()
        $tasks = $user->tasks()->get();
        return response()->json($tasks);
    }

    // Create a new task
    public function store(TaskRequest $request): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user(); // or Auth::user()
        $task = $user->tasks()->create($request->validated());
        return response()->json($task, 201);
    }

    // Show a specific task
    public function show(Task $task): JsonResponse
    {
        $this->authorize('view', $task);
        return response()->json($task);
    }

    // Update a task
    public function update(TaskRequest $request, Task $task): JsonResponse
    {
        $this->authorize('update', $task);
        $task->update($request->validated());
        return response()->json($task);
    }

    // Delete a task
    public function destroy(Task $task): JsonResponse
    {
        $this->authorize('delete', $task);
        $task->delete();
        return response()->json(['message' => 'Task deleted']);
    }
}