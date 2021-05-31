<?php

namespace App\Http\Controllers\API;

use App\Project;

class ProjectsController extends BaseController
{
	public function index()
	{
		$projects = Project::all();
		return $this->sendResponse($projects,'Projects retrieved successfully');
	}
	
	public function show(Project $project)
	{
		//dd(auth()->user());
		//dd($project);
		$this->authorize('view',$project);
		$project = Project::where('id',$project->id)->with(['owner:id,name,email','tasks'])->get();   ;
		return $this->sendResponse($project,'Project retrieved successfully');
	}
}