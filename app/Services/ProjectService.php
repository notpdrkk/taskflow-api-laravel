<?php

namespace App\Services;

use App\Exceptions\InvalidJsonFormat;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectService
{

    public function index()
    {
        try {
            return Project::all();
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred'], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'name' => 'required|string|max:100',
                'description' => 'nullable|max:255',
                'status' => 'required',
                'deadline' => 'nullable|date'
            ]);
            
            $project = Project::create($validated);
            return json_encode($project, 201);

        } catch (InvalidJsonFormat $e) {
            return response()->json(['invalid json format' => $e->getMessage()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}