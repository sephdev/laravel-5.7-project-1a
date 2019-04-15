<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = Project::where('owner_id', auth()->id())->get();
        return view('projects.index', compact('projects'));
    }
    
    public function show(Project $project)
    {                
        // abort_unless(auth()->user()->owns($project), 404);
        // abort_if ($project->owner_id !== auth()->id(), 404, 'Unauthorized action.');

        // abort_unless(\Gate::allows('update', $project), 403, 'Sorry, you are not authorized to access this page.');
        
        // $this->authorize('view', $project);
        // $this->authorize('update', $project);


        return view('projects/show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3']
        ]);        

        $attributes['owner_id'] = auth()->id();

        Project::create($attributes);
        return redirect('/projects');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }
    
    public function update(Project $project)
    {
        // $this->authorize('update', $project);

        $project->update(request(['title', 'description']));
        return redirect('/projects');
    }

    public function destroy(Project $project)
    {
        // $this->authorize('update', $project);

        $project->delete();
        return redirect('/projects');
    }
}
