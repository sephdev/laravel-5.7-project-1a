<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }
    
    public function show(Project $project)
    {        
        return $project;

        return view('projects/show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        Project::create(request(['title', 'description']));

        return redirect('/projects');

        // Project::create([
        //     'title' => request('title'),
        //     'description' => request('description')
        // ]);

        // $project = new Project();

        // $project->title = request('title');
        // $project->description = request('description');

        // $project->save();
        
        // json
        // return request()->all();
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    
    public function update(Project $project)
    {
        $project->update(request(['title', 'description']));

        return redirect('/projects');

        // $project->title = request('title');
        // $project->description = request('description');
        // $project->save();        
    }

    public function destroy(Project $project)
    {
        // Project::findOrFail($id)->delete();

        $project->delete();

        return redirect('/projects');
    }


}
