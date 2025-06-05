<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('completed')) { //if the request conatins a filter with name completed 
            $completed = $request['completed'] == "true" ? 1 : 0;
            $tasks  = Task::where('is_completed', $completed)->get();
        } else {
            $tasks = Task::all();
        }
        if ($tasks->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => [],
                'message' => "task list is empty",
                'status' => 200
            ], 200);
        }
        return response()->json([
            'success' => true,
            'data' => [
                'tasks' => $tasks
            ],
            'message' => "tasks  retrived successfully!",
            'status' => 200
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validtedData = $request->validate([
                'title' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
                'status' => 422
            ], 422);
        }
        $task = Task::create($validtedData);
        return response()->json([
            'success' => true,
            'data' => [
                'task' => $task
            ],
            'message' => 'task created successfully!',
            'status' => 200
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::where('id', $id)->first();
        if (!$task) { //if the model did not find the task
            return response()->json([
                'success' => false,
                'message' => "task with id $id not found",
                'status' => 404
            ], 404);
        }
        $task->is_completed = true;
        $task->save();
        return response()->json([
            'success' => true,
            'data' => [
                'task' => $task
            ],
            'message' => "task marked as complete",
            'status' => 200
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::where('id', $id)->first();
        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => "task with id $id not found",
                "status" => 403,
            ], 403);
        }
        $task->delete();
        return response()->json([
            'success' => true,
            'message' => "task deleted successfully",
            'status' => 200,
        ], 200);
    }
}
