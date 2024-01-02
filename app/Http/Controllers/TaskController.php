<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function list()
    {
        $tasks = Task::paginate();

        return TaskResource::collection($tasks);
    }

    public function create(Request $request)
    {
        $data = $request->all();

        $task = Task::create($data);

        return new TaskResource($task);
    }

    public function update(Request $request, String $id)
    {
        $tasks = Task::all();

        $task = $tasks->find($id);

        if (!$task) {
            return response()->json(["message" => "Task not found"], Response::HTTP_NOT_FOUND);
        }

        $data = $request->all();
        $task->update($data);

        return new TaskResource($task);
    }

    public function delete(String $id)
    {
        $tasks = Task::all();

        $task = $tasks->find($id);

        if (!$task) {
            return response()->json(["message" => "Task not found"], Response::HTTP_NOT_FOUND);
        }

        $task->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
