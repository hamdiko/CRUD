@extends('layouts.app')
@section('content')
<div class="container">
	<h1>{{$project->title}}</h1>
	<div>{{$project->description}}</div>
	<a href="/projects/{{$project->id}}/edit">Edit</a>
	@if($project->tasks->count())
	<div class="container">
		<h6>Project Tasks</h6>
		<ul>
			@foreach($project->tasks as $task)
				<form action="/tasks/{{$task->id}}" method="post">
					@method('patch')
					@csrf
				<input type="checkbox" name="completed" onchange="this.form.submit()" {{$task->completed? 'checked':''}}> {{$task->description}}
				</form>
			@endforeach
		</ul>

	</div>
	@endif
	<div class="container">

		<form action="/tasks" method="post">
			@csrf
			<div class="form-group">
				<label for="exampleInputEmail1">add task</label>
				<input type="text" name="description" class="form-control"  required>
				<input type="hidden" name="project_id" value="{{$project->id}}">
			</div>

			@include('includes.errors')
			<button type="submit" class="btn btn-primary">add task</button>
		</form>

	</div>
</div>
@endsection