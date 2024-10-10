<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
       $project = Project::find($id);
       return response()->json($project);
   }

   // Cập nhật dự án
   public function update(Request $request, $id)
   {
       $project = Project::find($id);
       $project->update($request->all());
       return response()->json([
           'message' => 'Dự án được cập nhật',
           'project' => $project
       ]);
   }

   // Xóa dự án
   public function destroy($id)
   {
       Project::find   ($id)->delete();
       return response()->json(['message' => 'Dự án được xóa']);
   }
}
