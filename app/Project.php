<?php

namespace App;

use App\Events\ProjectCreatedEvent;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
	protected $fillable = ['title','description','owner_id'];
	protected $dispatchesEvents = [
		'created'=>ProjectCreatedEvent::class
	];
	public function tasks(){
		return $this->hasMany(Task::class);
	}
	
	public function addTask($task){
		$this->tasks()->create($task);
	}
	
	public function owner(){
		return $this->belongsTo(User::class,'owner_id','id');
	}
}
