<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$attributes = $request->validate([
    		'description'=>'required|min:3'
	    ]);
	    $attributes['project_id'] = $request->get('project_id');
	    $project = Project::findOrFail($request->get('project_id'));
        $project->addTask($attributes);
        //$project->tasks()->create($attributes); //another way
	    //Task::create($attributes); // another way
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
    	//better encapsulation to create complete method in the model
	    // way num 2
	    $task->complete($request->has('completed'));
	    //2
	    /*if($request->has('completed'))
	    	$task->complete();
	    else
	    	$task->incomplete();*/
	    //3
	    //$request->has('completed') ? $task->complete() : $task->incomplete();
	    return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
