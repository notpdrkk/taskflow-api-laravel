<?php

namespace App\Services;

use App\Exceptions\InvalidJsonFormat;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\DTO\ProjectResponseDTO;

class ProjectService
{

    public function index()
    {
        try {
            return ProjectResponseDTO::all()->from(Project::all());
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred'], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'description' => 'nullable|max:255',
                'status' => 'required',
                'deadline' => 'nullable|date'
            ]);
            $project = Project::create($validated);
            return ProjectResponseDTO::from($project);
        } catch (InvalidJsonFormat $e) {
            return response()->json(['invalid json format' => $e->getMessage()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}