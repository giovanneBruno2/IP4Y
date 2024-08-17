<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('project.index', [
                'projects' => Projects::all()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('project.create',  [
            'projects' => new Projects(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $project = new Projects();
        $project->setProjectTitle($request->get('project_title'));
        $project->setDescription($request->get('description'));
        $project->save();

        return redirect()->route('project.index');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Projects $project)
    {
        $project->load(['tasks.assignedUser']);
        return view('project.task', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projects $project)
    {
        return view('project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projects $project)
    {
        $request->validate([
            'project_title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);
        $project->update([
            'project_title' => $request->input('project_title'),
            'description' => $request->input('description'),
        ]);
        return redirect()->route('project.index')->with('success', 'Project  updated successfully!');;
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projects $project)
    {
        $project->delete();
        return redirect()->route('project.index')->with('success', 'Project  updated successfully!');;
    }
}
