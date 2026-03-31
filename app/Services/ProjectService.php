<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectService
{

    public function index()
    {
        return Project::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|max:255',
            'status' => 'required',
            'deadline' => 'nullable|date'
        ]);

        $project = Project::create($validated);
        return $project;
    }
}