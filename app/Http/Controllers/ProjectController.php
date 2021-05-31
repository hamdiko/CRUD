<?php

namespace App\Http\Controllers;

use App\Events\ProjectCreatedEvent;
use App\Jobs\SendProjectCreatedMail;
use App\Mail\ProjectCreated;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
	/**
	 * ProjectController constructor.
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	
        $projects = Project::where('owner_id',auth()->id())->get();
        
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
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
		    'title'=>'required|min:3|max:255',
		    'description'=>'required|min:3|max:500'
	    ]);
	    $attributes['owner_id'] = auth()->id();
	    //dd($attributes);
    	$project = Project::create($attributes);

//	    $project = new Project();
//	    $project->create($request->all());
//	    $project->title = $request->title;
//	    $project->description = $request->description;
//	    $project->save();
	    
	    // send mail way 1
	    //Mail::to(auth()->user()->email)->send(new ProjectCreated($project));
	    // send mail through job queue way2
	    dispatch(new SendProjectCreatedMail($project));
	    // also you can hook your event in the model with the created hook >> check project model
	    //send mail though event listener way 3
	    //event(new ProjectCreatedEvent($project));
	    
	    return redirect('projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
    	$this->authorize('view',$project);
    	//abort_if($project->owner_id !== auth()->id(),403,'your are not authorized to view this page');
        return view('projects.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
    	$this->authorize('view',$project);
        return view('projects.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
	    $this->authorize('view',$project);
	    $project->update($request->all());
	    
//	    $project->title = $request->title;
//	    $project->description = $request->description;
//	    $project->save();
	    return redirect('projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
	    $this->authorize('view',$project);
        $project->delete();
        return redirect('projects');
    }
}
