<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;

class TasksController extends Controller
{
    protected $rules = [
        'name' => 'required|min:3',
        'slug' => 'required',
        'description' => 'required',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('tasks.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $validatedData  = $request->validate($this->rules);
        $input = array_except($request->all(), ['_method', 'completed']);
        
        if ($request->completed == '') {
            $input['completed'] = 0;
        } else {
            $input['completed'] = 1;
        }

        $input['project_id'] = $project->id;
        Task::create($input);
        return redirect()->route('projects.show', $project->slug)->with('message', 'Task Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Task $task)
    {
        return view('tasks.show', compact('project', 'task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Task $task)
    {
        return view('tasks.edit', compact('project', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, Task $task)
    {
        $validatedData  = $request->validate($this->rules);
        $input = array_except($request->all(), ['_method', 'completed']);
        
        if ($request->completed == '') {
            $input['completed'] = 0;
        } else {
            $input['completed'] = 1;
        }

        $task->update($input);
        return redirect()->route('projects.show',$project->slug)->with('mesage', 'Task eEited');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        return redirect()->route('projects.show', $project->slug)->with('message', 'Task Deleted');
    }
}
