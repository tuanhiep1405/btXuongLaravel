<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Tạo nhiệm vụ mới cho dự án
    public function store(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);

        $task = $project->tasks()->create($request->all());

        return response()->json([
            'message' => 'Nhiệm vụ được tạo',
            'task' => $task
        ], 201);
    }

    // Xem danh sách nhiệm vụ của dự án
    public function index($projectId)
    {
        $project = Project::findOrFail($projectId);
        return response()->json($project->tasks);
    }

    // Xem chi tiết nhiệm vụ
    public function show($projectId, $taskId)
    {
        $task = Task::where('project_id', $projectId)->findOrFail($taskId);
        return response()->json($task);
    }

    // Cập nhật nhiệm vụ
    public function update(Request $request, $projectId, $taskId)
    {
        $task = Task::where('project_id', $projectId)->findOrFail($taskId);
        $task->update($request->all());

        return response()->json([
            'message' => 'Nhiệm vụ được cập nhật',
            'task' => $task
        ]);
    }

    // Xóa nhiệm vụ
    public function destroy($projectId, $taskId)
    {
        $task = Task::where('project_id', $projectId)->findOrFail($taskId);
        $task->delete();

        return response()->json(['message' => 'Nhiệm vụ được xóa']);
    }
}
