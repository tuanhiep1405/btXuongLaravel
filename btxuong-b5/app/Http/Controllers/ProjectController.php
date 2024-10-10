<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Xem danh sách dự án
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }


    // Tạo dự án mới
    public function store(Request $request)
    {
        $project = Project::create($request->all());
        return response()->json([
            'message' => 'Dự án được tạo thành công',
            'project' => $project
        ], 201);
    }


    // Xem chi tiết dự án
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return response()->json($project);
    }

    // Cập nhật dự án
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());
        return response()->json([
            'message' => 'Dự án được cập nhật',
            'project' => $project
        ]);
    }

    // Xóa dự án
    public function destroy($id)
    {
        Project::findOrFail($id)->delete();
        return response()->json(['message' => 'Dự án được xóa']);
    }
}
