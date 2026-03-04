<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

public function store(StoreProjectRequest $request)
{
    $data = $request->validated();

    if ($request->hasFile('screenshot')) {
        $data['screenshot'] = $request->file('screenshot')->store('projects', 'public');
    }

    Project::create($data);

    return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
}


    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

public function update(UpdateProjectRequest $request, Project $project)
{
    $data = $request->validated();

    if ($request->input('remove_screenshot') == '1' && $project->screenshot) {
        Storage::disk('public')->delete($project->screenshot);
        $data['screenshot'] = null;
    }

    if ($request->hasFile('screenshot')) {
        if ($project->screenshot) {
            Storage::disk('public')->delete($project->screenshot);
        }
        $data['screenshot'] = $request->file('screenshot')->store('projects', 'public');
    }

    $project->update($data);

    return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
}

    public function destroy(Project $project)
    {
        if ($project->screenshot) {
            Storage::disk('public')->delete($project->screenshot);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted.');
    }
}